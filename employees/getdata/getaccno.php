<?php
require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmpNumber = getNewEmployeeNumber($conn);
    echo json_encode($newEmpNumber);
}
