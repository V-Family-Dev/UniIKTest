<?php
require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bankid = $_POST['bankID'];
    $stmt = $conn->prepare("SELECT  `branchID`, `branchName` FROM `bankbranches` WHERE `bankID`=?");
    $stmt->bind_param('i', $bankid);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['branchID'],
            'name' => $row['branchName']
        ];
    }
}
echo json_encode($data);
