<?php



require_once '../functions/sales/upDownFunction.php';
require_once '../functions/wallet/walletFunctions.php';
require_once '../DB/dbconfig.php';
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

header('Content-Type: application/json');

// if (isset($_GET['action']) && $_GET['action'] == 'gettask' && isset($_GET['employeeId'])) {
//     $empId = $_GET['employeeId'];
//     $empTask = getTasksByEmployee($empId, $conn);


//        $referralLevels = getReferralLevels($empnewId, $conn);
//         // Return the result as JSON
//         $totalEarnings = calculateEarnings($empId, $empTask, $referralLevels['upward']);
//         echo json_encode($totalEarnings);


// } else {
//     // Handle the invalid request
//     echo json_encode(['error' => 'Invalid request']);
// }

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process Excel file upload
    if (isset($_FILES['fileToUpload'])) {
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


                $soId = $row['A'];
                $empid = $row['B'];
                $deliveryDate = $row['C'];
                $returnDate = $row['D'];

                $updateResult = updateOrder($soId, $deliveryDate, $returnDate, $conn);
                if ($updateResult == 1) {
                    $result = processOrder($soId, $conn);
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
    }
    // Process form submission
    elseif (isset($_POST['action']) && $_POST['action'] == 'updateOrder') {
        $soId = $_POST['soId'];
        $deliveryDate = $_POST['deliveryDate'];
        $returnDate = $_POST['returnDate'];

        $updateResult = updateOrder($soId, $deliveryDate, $returnDate, $conn);
        if ($updateResult == 1) {
            $result = processOrder($soId, $conn);
            $response['message'] = 'success update';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error updating order';  

        } // Assume processOrder returns a response array
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No valid data received';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}


echo json_encode($response);

function processOrder($soId, $conn)
{

    $response = [];


    $task = getTasksByEmployee($soId, $conn);
    if ($task) {
        $empId = $task[0]['employee_no'];
        $referralLevels = getReferralLevels($empId, $conn);
        $totalEarnings = calculateEarnings($empId, $task, $referralLevels['upward']);
        updateWallet($totalEarnings, $conn);
        $response['status'] = 'success';
        $response['data'] = $totalEarnings;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No tasks found';
    }
    return $response;
}
