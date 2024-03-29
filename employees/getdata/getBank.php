<?php
require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare("SELECT `ID`,`name` FROM `banks`");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['ID'],
            'name' => $row['name']
        ];
    }



    echo json_encode($data);
}
