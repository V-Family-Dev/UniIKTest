<?php
function updateOrder($soId, $deliveryDate, $returnDate, $conn) {
    // First, check if the sales order already has delivery or return dates
    $checkStmt = $conn->prepare("SELECT delivery_date, return_date FROM salesorder WHERE so_id = ?");
    $checkStmt->bind_param("s", $soId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $order = $result->fetch_assoc();
    $checkStmt->close();


    if (!empty($order['delivery_date']) || !empty($order['return_date'])) {
        return 2; // Return 2 if either date is already set
    }

   
    $sql = "UPDATE salesorder SET ";
    $params = [];
    $types = "";

   
    if (!empty($deliveryDate)) {
        $sql .= "delivery_date = ?, ";
        $params[] = $deliveryDate;
        $types .= "s"; // 's' denotes a string parameter
    } else {
     
        $sql .= "delivery_date = delivery_date, ";
    }

    if (!empty($returnDate)) {
        $sql .= "return_date = ?, ";
        $params[] = $returnDate;
        $types .= "s";
    } else {
       
        $sql .= "return_date = return_date, ";
    }

    $sql = rtrim($sql, ", "); 
    $sql .= " WHERE so_id = ?";
    $params[] = $soId;
    $types .= "i"; 

    // Prepare the update statement
    $updateStmt = $conn->prepare($sql);
    $updateStmt->bind_param($types, ...$params);
    $updateResult = $updateStmt->execute();
    $updateStmt->close();

    return $updateResult ? 1 : 0; // Return 1 if update was successful, otherwise 0
}


function getTasksByEmployee($empId, $conn)
{
    $sql = "SELECT 
    so.so_id,
    em.employee_no,
    so.sales_date,
    so.delivery_date,
    so.return_date,
    so.so_status,
    ism.quantity,
    im.item_code,
    im.Item_name,
    im.price,
    im.level_1,
 	im.level_2, 
	im.level_3, 
	im.level_4,
	im.level_5,
	im.level_5
FROM 
    salesorder so
JOIN 
   itemmaster_salesorder ism ON so.so_id = ism.salesorder_id
JOIN 
    item_master im ON ism.itemmaster_id = im.Item_id
JOIN
	employee em ON so.emp_no=em.id
WHERE 
so.so_id= ?
    AND so.isActive = 1   -- Assuming isActive is a flag to indicate active sales orders
    AND so.delivery_date != 0";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results into an array
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    // Close the statement
    $stmt->close();

    // Return the tasks
    return $tasks;
}


function calculateEarnings($empId, $empTasks, $upwardReferrals) {
    $totalEarnings = [];

    foreach ($empTasks as $task) {
        if (isset($task['level_1'])) {
            $earnings = $task['level_1'] * $task['quantity']; // Use level_1 for main employee
            if (isset($totalEarnings[$empId])) {
                $totalEarnings[$empId] += $earnings;
            } else {
                $totalEarnings[$empId] = $earnings;
            }
        }
    }
    // Calculate referral earnings
    foreach ($upwardReferrals as $refEmpId => $level) {
        if ($level > 6) {
            continue; // Skip levels greater than 6
        }

        $refLevelEarningKey = 'level_' . $level;
        foreach ($empTasks as $task) {
            if (isset($task[$refLevelEarningKey])) {
                $earnings = $task[$refLevelEarningKey] * $task['quantity'];
                if (isset($totalEarnings[$refEmpId])) {
                    $totalEarnings[$refEmpId] += $earnings;
                } else {
                    $totalEarnings[$refEmpId] = $earnings;
                }
            }
        }
    }

    return $totalEarnings;
}

function updateWallet($totalEarnings, $conn) {

    $isFirst = true;
foreach ($totalEarnings as $empNo => $earnings) {
    // Prepare and execute the query to get the actual employee ID
    if (!($empIdStmt = $conn->prepare("SELECT id FROM employee WHERE employee_no = ?"))) {
        error_log("Prepare failed: " . $conn->error);
        continue; // Skip to the next iteration
    }
    
    if (!$empIdStmt->bind_param("s", $empNo)) {
        error_log("Binding parameters failed: " . $empIdStmt->error);
        continue; // Skip to the next iteration
    }
    
    if (!$empIdStmt->execute()) {
        error_log("Execute failed: " . $empIdStmt->error);
        continue; // Skip to the next iteration
    }

    $empIdResult = $empIdStmt->get_result();
    if ($empIdResult->num_rows == 0) {
        continue; // Skip if no matching employee found
    }

    $empIdRow = $empIdResult->fetch_assoc();
    $employeeId = $empIdRow['id']; // Actual employee ID

    // Prepare and execute the query to check wallet record
    if (!($stmt = $conn->prepare("SELECT total_earnings, direct_commission, indirect_commission FROM wallet WHERE employee_no = ?"))) {
        error_log("Prepare failed: " . $conn->error);
        continue;
    }

    if (!$stmt->bind_param("i", $employeeId)) {
        error_log("Binding parameters failed: " . $stmt->error);
        continue;
    }

    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        continue;
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Update existing wallet record
        $row = $result->fetch_assoc();
    
        // Existing values
        $currentTotalEarnings = $row['total_earnings'];
        $currentDirectCommission = $row['direct_commission'];
        $currentIndirectCommission = $row['indirect_commission'];
    
        // Calculate new values
        $newDirectCommission = $currentDirectCommission + ($isFirst ? $earnings : 0);
        $newIndirectCommission = $currentIndirectCommission + ($isFirst ? 0 : $earnings);
        $newTotalEarnings = $currentTotalEarnings + $earnings; // Add new earnings to existing total
    
        // Update statement
        if (!($updateStmt = $conn->prepare("UPDATE wallet SET total_earnings = ?, direct_commission = ?, indirect_commission = ? WHERE employee_no = ?"))) {
            error_log("Prepare failed: " . $conn->error);
            continue;
        }
    
        if (!$updateStmt->bind_param("dddi", $newTotalEarnings, $newDirectCommission, $newIndirectCommission, $employeeId)) {
            error_log("Binding parameters failed: " . $updateStmt->error);
            continue;
        }
    
        if (!$updateStmt->execute()) {
            error_log("Execute failed: " . $updateStmt->error);
            continue;
        }
    } else {
        // Insert new wallet record
        $directCommission = $isFirst ? $earnings : 0;
        $indirectCommission = $isFirst ? 0 : $earnings;

        if (!($insertStmt = $conn->prepare("INSERT INTO wallet (employee_no, total_earnings, direct_commission, indirect_commission) VALUES (?, ?, ?, ?)"))) {
            error_log("Prepare failed: " . $conn->error);
            continue;
        }

        if (!$insertStmt->bind_param("iddd", $employeeId, $earnings, $directCommission, $indirectCommission)) {
            error_log("Binding parameters failed: " . $insertStmt->error);
            continue;
        }

        if (!$insertStmt->execute()) {
            error_log("Execute failed: " . $insertStmt->error);
            continue;
        }
    }

    $isFirst = false;
}

}
