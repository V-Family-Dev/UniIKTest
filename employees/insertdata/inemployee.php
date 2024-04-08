<?php
require_once "../../DB/dbconfig.php";

require_once "../../functions/employee/employeesFunctions.php";

header('Content-Type: application/json');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $nic = $_POST['nic'] ?? '';
    $reference_id = $_POST['reference_id'] ?? '';
    $phone_no = $_POST['phone_no'] ?? '';
    $whatsapp_no = $_POST['whatsapp_no'] ?? '';
    $address = $_POST['address'] ?? '';
    $province = $_POST['province'] ?? '';
    $districts = $_POST['districts'] ?? '';
    $city = $_POST['city'] ?? '';
    $postalCode = $_POST['postalCode'] ?? '';
    $bankName = $_POST['bankName'] ?? '';
    $bankCode = $_POST['bankCode'] ?? '';
    $branchName = $_POST['branchName'] ?? '';
    $branchCode = $_POST['branchCode'] ?? '';
    $accountHolderName = $_POST['accountHolderName'] ?? '';
    $accountNum = $_POST['AccountNum'] ?? '';

    $getempid = getNewEmployeeNumbers($conn);
    $lastid = dataaddemp($conn, $getempid, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branchCode, $address, $postalCode, $accountNum, $accountHolderName, $reference_id, $bankCode);
    //add login details
    $password = password();
    if (adduser($conn, $getempid, $password)) {
        echo json_encode(["status" => "success", "message" => "Employee updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error message here", "error" => "Optional error details"]);
    }
}




function dataaddemp($conn, $getempid, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branchCode, $address, $postalCode, $accountNum, $accountHolderName, $reference_id, $bankCode)
{
    $sql = $conn->prepare("INSERT INTO employee (employee_no, first_name, last_name, NIC, phone_no, whatsapp_no, BankCode, Address, postcode, AccountNum, holderName, reference_id, bank_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssissssis", $getempid, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branchCode, $address, $postalCode, $accountNum, $accountHolderName, $reference_id, $bankCode);
    $sql->execute();
    $lastid = $conn->insert_id;
    return $lastid;
}

function getNewEmployeeNumbers($conn)
{
    $sql = "SELECT employee_no FROM employee ORDER BY employee_no DESC LIMIT 1;";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastEmpNumber = $row['employee_no'];

        $prefix = 'USD'; // Constant prefix
        $numberPart = ltrim(substr($lastEmpNumber, strlen($prefix)), '0'); // Remove leading zeros
        $number = $numberPart === '' ? 0 : intval($numberPart); // Handle the case where $numberPart is empty
        $number++;

        // Determine new length of number part
        $newNumberLength = strlen((string)$number);

        // Pad the number if it's shorter than 4 digits
        if ($newNumberLength < 4) {
            $formattedNumber = str_pad($number, 4, "0", STR_PAD_LEFT);
        } else {
            $formattedNumber = (string)$number;
        }

        // Concatenate back to get the new employee number
        $newEmpNumber = $prefix . $formattedNumber;

        return $newEmpNumber;
    } else {
        // Handle the case where there are no employees
        return 'USD0001';
    }
}
