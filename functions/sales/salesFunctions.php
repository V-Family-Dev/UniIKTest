<?php
//get emp id with other data 
function getEmpId($conn)
{
    {
        $sql = "SELECT id,employee_no,first_name,last_name,phone_no,Address FROM employee where EmpStatus=1";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $empNumber = [];
            while ($row = $result->fetch_assoc()) {
                $empNumber[] = $row;
            }
        }
    
        return $empNumber;
    }
    
}

//get item data 
function getItemData($conn)
{
    {
        $sql = "SELECT Item_id,item_code,Item_name,price FROM item_master where item_status=1";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $empNumber = [];
            while ($row = $result->fetch_assoc()) {
                $empNumber[] = $row;
            }
        }
    
        return $empNumber;
    }
    
}


function insertOrderData($conn, $employeeId, $orderDate, $totalEarning, $orderData) {
    // Insert into sales_order table
    $stmt = $conn->prepare("INSERT INTO salesorder (emp_no, sales_date, total_eren) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $employeeId, $orderDate, $totalEarning);
    $stmt->execute();

    // Get the last inserted ID
    $salesOrderId = $conn->insert_id;
    $stmt->close();

    // Insert into order_item table
    $stmt = $conn->prepare("INSERT INTO itemmaster_salesorder (salesorder_id, itemmaster_id, quantity) VALUES (?, ?, ?)");
    foreach ($orderData as $item) {
        $itemCode =(int) $item['itemCode'];
        $itemQuantity = (int)$item['itemQuantity'];
        $stmt->bind_param("iii", $salesOrderId, $itemCode, $itemQuantity);
        $stmt->execute();
    }

    $stmt->close();
}
