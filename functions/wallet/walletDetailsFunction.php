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
