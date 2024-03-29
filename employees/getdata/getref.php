<?php
require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = 1;

    $stmt = $conn->prepare("SELECT * FROM `employee` WHERE `EmpStatus`=?");
    $stmt->bind_param('s', $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['employee_no'],

        ];
    }
}
echo json_encode($data);










