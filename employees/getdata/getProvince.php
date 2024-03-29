<?php

require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provinces = provinces($conn);
    foreach ($provinces as $province) {
        $data[] = [
            'id' => $province['id'],
            'name_en' => $province['name_en']
        ];
    }
}
echo json_encode($data);
