<?php

require_once '../functions/sales/showOrderFunction.php';
require_once '../DB/dbconfig.php';
header('Content-Type: application/json');


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'salesdata':
            // Handle the 'salesdata' action
            $allDetailsSalesOrder = getAllSalesOrderDetails($conn);
            echo json_encode(["status" => "success", "data" => $allDetailsSalesOrder]);

            break;
            
        default:
            // Optional: Handle unknown action
            echo "Unknown action";
    }
} else {
    echo "No action specified";
}

