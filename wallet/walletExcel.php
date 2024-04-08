<?php
require_once '../DB/dbconfig.php';
require "../vendor/autoload.php";
require_once '../functions/wallet/walletDetailsFunction.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportWalletToExcel($conn) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers
    $headers = ['ID', 'Employee No','First Name', 'Last Name', 'Total Earnings', 'Total Payed', 'Direct Commission', 'Indirect Commission', 'Last Payment Date'];
    $sheet->fromArray($headers, NULL, 'A1');

    // Fetch data from database
    $data = getWalletWithEmployeeDetails($conn);

    if (!is_array($data)) {
        // If an error occurs, return it
        return $data;
    }

    // Starting from row 2 because we added headers already
    $rowNum = 2;
    foreach ($data as $row) {
        // Insert data row by row into the spreadsheet
        $sheet->fromArray(array_values($row), NULL, 'A' . $rowNum);
        $rowNum++;
    }

    $writer = new Xlsx($spreadsheet);

    // Set the Content-Type and Content-Disposition headers to force the download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="wallet_data.xlsx"');

    $writer->save('php://output'); // This will output the file to the browser for download
}

// Call the export function
exportWalletToExcel($conn);


?>