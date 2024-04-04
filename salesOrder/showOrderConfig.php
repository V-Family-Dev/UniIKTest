<?php

require_once '../functions/sales/showOrderFunction.php';
require_once '../DB/dbconfig.php';
header('Content-Type: application/json');

// Assuming database connection is already established in $conn
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Database connection
    // (Ensure you have your database connection here.)

    switch ($action) {
        case 'salesdata':
            // Handle the 'salesdata' action
            $allDetailsSalesOrder = getAllSalesOrderDetails($conn);
            echo json_encode(["status" => "success", "data" => $allDetailsSalesOrder]);

            break;
            // Add more cases for other actions

            // ... add other cases as needed ...
        default:
            // Optional: Handle unknown action
            echo "Unknown action";
    }
} else {
    echo "No action specified";
}


