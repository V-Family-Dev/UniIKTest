<?php

require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $district_id = $_POST['districtId'];
    $stmt = $conn->prepare("SELECT `id`,`name_en`,`postcode` FROM `cities` WHERE `district_id` = ?");
    $stmt->bind_param("i", $district_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['id'],
            'name_en' => $row['name_en'],
            'postcode' => $row['postcode']
        ];
    }

    $stmt->close();



    echo json_encode($data);
}
