<?php


require_once '../DB/dbconfig.php';
require_once '../functions/wallet/walletDetailsFunction.php';
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    // Handle file upload
    // Your existing file upload logic here
    $file = $_FILES['fileToUpload']['tmp_name'];
    try {
        $spreadsheet = IOFactory::load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $isFirstRow = true; // Flag to check if it's the first row
        $processedData = []; // Array to hold all processed data
        foreach ($sheetData as $row) {
            if ($isFirstRow) {
                $isFirstRow = false; // Set the flag to false after the first row
                continue; // Skip the first row
            }


            $walletId = $conn->real_escape_string($row['A']);
            $total_earning = $conn->real_escape_string($row['E']);
            $Total_payed = $conn->real_escape_string($row['F']);
            $directcommision = $conn->real_escape_string($row['G']);
            $indirectcommision = $conn->real_escape_string($row['H']);
            $last_updated = $conn->real_escape_string($row['I']);

            $result = updateWallet($total_earning, $Total_payed, $directcommision, $indirectcommision, $last_updated, $walletId, $conn);
            if ($result) {
                $response = ['success' => "update successfull..."];
            } else {
                continue; // Skip further processing for this row and move to the next
                // Update failed, log this information

            }
        }
        $response['status'] = 'success';
        $response['message'] = 'File processed successfully';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error processing file: ' . $e->getMessage();
    }
} elseif (isset($_GET['action'])) {
    // Handle different actions based on 'action' parameter
    $action = $_GET['action'];

    switch ($action) {
        case 'walletdata':
            // Handle the 'walletdata' action
            $allDetails = getWalletWithEmployeeDetails($conn);
            echo json_encode(["status" => "success", "data" => $allDetails]);
            break;

            // Add more cases for other actions

        default:
            // Optional: Handle unknown action
            echo json_encode(["status" => "error", "message" => "Unknown action"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No action specified"]);
}
