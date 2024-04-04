<?php

require_once '../functions/sales/salesFunctions.php';
require_once '../DB/dbconfig.php';
header('Content-Type: application/json');



// Assuming database connection is already established in $conn

// Determine the request method and fetch the action
$method = $_SERVER['REQUEST_METHOD'];
$action = '';
if ($method == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
} elseif ($method == 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';
}

// Process based on action
switch ($action) {
    case 'submitOrder':
        // Handle submit order action
        if (isset($_POST['employeeId'], $_POST['orderDate'],$_POST['totalearning'] ,$_POST['orderData'])) {
            $employeeId = $_POST['employeeId'];
            $orderDate = $_POST['orderDate'];  // Retrieve the order date
            $orderData = $_POST['orderData'];
            $totalEarning = $_POST['totalearning'];
            insertOrderData($conn, $employeeId, $orderDate, $totalEarning, $orderData);
            echo json_encode([
                "status" => "success"
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "No order data provided"]);
        }
        break;

    case 'empdata':
        // Handle employee data action
        $getEmpId = getEmpId($conn);
        echo json_encode(["status" => "success", "data" => $getEmpId]);
        break;

    case 'itemdata':
        // Handle item data action
        $getItemData = getItemData($conn);
        echo json_encode(["status" => "success", "data" => $getItemData]);
        break;

        // Add more cases as needed

    default:
        echo json_encode(["status" => "error", "message" => "Invalid action"]);
        break;
}

// Helper functions (getEmpId, getItemData, etc.)
// ...
