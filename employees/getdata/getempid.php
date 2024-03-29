<?php
require "../../DB/dbconfig.php";
require "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');

function getNewEmployeeNumberWithErrorHandling($conn)
{
    try {
        return getNewEmployeeNumber($conn);
    } catch (Exception $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode(['employeeNumber' => getNewEmployeeNumberWithErrorHandling($conn)]);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}
