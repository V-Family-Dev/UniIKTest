<?php
function getWalletWithEmployeeDetails($conn)
{
    $sql = "SELECT	w.id,
            e.employee_no,
            e.first_name,
            e.last_name,
            w.total_earnings,
            w.total_payed,
            w.direct_commission,
            w.indirect_commission,
            w.LastPayementDate
  FROM
    wallet w
  JOIN
    employee e ON w.employee_no = e.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    } else {
        $stmt->close();
        // Handle error
        return "Error: " . $conn->error;
    }
}


function updateWallet($total_earning, $Total_payed, $directcommision, $indirectcommision, $last_updated, $walletId, $conn) {
    $sql = "UPDATE wallet SET 
                total_earnings = ?, 
                total_payed = ?, 
                direct_commission = ?, 
                indirect_commission = ?, 
                LastPayementDate = ?
            WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ddddsi", $total_earning, $Total_payed, $directcommision, $indirectcommision, $last_updated, $walletId);
        $stmt->execute();
        $result = $stmt->affected_rows; // Get the number of affected rows
        $stmt->close();

        return $result > 0;
    } else {
        // Optional: Handle error in preparation of statement
        return false;
    }
}
