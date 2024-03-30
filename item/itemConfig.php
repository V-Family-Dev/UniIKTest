<?php
require '../DB/dbconfig.php';
require '../functions/item/itemFunction.php';
header('Content-Type: application/json');


$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action !== '') {
    // Handle AJAX requests
    if ($action === 'toggleStatus') {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $newStatus = isset($_POST['newStatus']) ? $_POST['newStatus'] : null;

        if (empty($id) || $newStatus === null) {
            echo json_encode(["status" => "error", "message" => "Error: Missing ID or Status"]);
        } else {
            $updateResult = updateItemStatus($conn, $id, $newStatus);
            if ($updateResult === true) {
                echo json_encode(["status" => "success", "message" => "Item status updated successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update item status"]);
            }
        }
    }
    // You can add more elseif for other AJAX actions
} else {
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $itemCode = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';
        $itemName = isset($_POST['itemName']) ? $_POST['itemName'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $level_1 = isset($_POST['level_1']) ? $_POST['level_1'] : '';
        $level_2 = isset($_POST['level_2']) ? $_POST['level_2'] : '';
        $level_3 = isset($_POST['level_3']) ? $_POST['level_3'] : '';
        $level_4 = isset($_POST['level_4']) ? $_POST['level_4'] : '';
        $level_5 = isset($_POST['level_5']) ? $_POST['level_5'] : '';
        $level_6 = isset($_POST['level_6']) ? $_POST['level_6'] : '';

        // Perform your validation and database operations here

        // Example: check if fields are empty
        if (empty($itemCode) || empty($itemName) || empty($price) || empty($level_1) || empty($level_2) || empty($level_3) || empty($level_4) || empty($level_5) || empty($level_6)) {
            echo json_encode(["status" => "error", "message" => "Error: Missing fields"]);
        } else {

            $addItems = itemDataInsert($conn, $itemCode, $itemName, $price, $level_1, $level_2, $level_3, $level_4, $level_5, $level_6);

            // For now, just echoing back received data for testing
            if ($addItems === true) {
                echo json_encode(["status" => "success", "message" => "Item added successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to add item"]);
            }
        }
    }
}


$action = isset($_GET['action']) ? $_GET['action'] : '';
$status = isset($_GET['status']) ? intval($_GET['status']) : 1;

if ($action === 'getItems') {
    $activeItems = getItems($conn, $status);
    if ($activeItems === false) {
        // Query failed
        echo json_encode(["status" => "error", "message" => "Database query failed"]);
    } elseif (is_null($activeItems)) {
        // No items found
        echo json_encode(["status" => "error", "message" => "No active items found"]);
    } else {
        // Items found
        echo json_encode(["status" => "success", "data" => $activeItems]);
    }
}
