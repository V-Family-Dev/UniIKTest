<?php


require_once '../DB/dbconfig.php';
require_once '../functions/wallet/walletDetailsFunction.php';
require "../vendor/autoload.php";


header('Content-Type: application/json');



if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'walletdata':
            // Handle the 'salesdata' action
            $allDetails= getWalletWithEmployeeDetails($conn);
            echo json_encode(["status" => "success", "data" => $allDetails]);

            break;
            
        default:
            // Optional: Handle unknown action
            echo "Unknown action";
    }
} else {
    echo "No action specified";
}


