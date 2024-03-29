<?php
require "../DB/dbconfig.php";
require "../functions/employee/employeesFunctions.php";
header('Content-Type: application/json');
















































if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $firstNameErr = "First Name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
    }
    if (empty($_POST["lastName"])) {
        $lastName = "";
    } else {
        $lastName = test_input($_POST["lastName"]);
    }
    if (empty($_POST["nic"])) {
        $nicErr = "NIC is required";
    } else {
        $nic = test_input($_POST["nic"]);
    }
    if (empty($_POST["employeeNumber"])) {
        $employeeNumberErr = "Employee Number is required";
    } else {
        $employeeNumber = test_input($_POST["employeeNumber"]);
    }
    if (empty($_POST["refNumber"])) {
        $refNumber = "";
    } else {
        $refNumber = test_input($_POST["refNumber"]);
    }
    if (empty($_POST["primaryNumber"])) {
        $primaryNumber = "";
    } else {
        $primaryNumber = test_input($_POST["primaryNumber"]);
    }
    if (empty($_POST["secondaryNumber"])) {
        $secondNumber = "";
    } else {
        $secondNumber = test_input($_POST["secondaryNumber"]);
    }
    if (empty($_POST["address"])) {
        $address = "";
    } else {
        $address = test_input($_POST["address"]);
    }
    if (empty($_POST["joinDate"])) {
        $joindate = "";
    } else {
        $joindate = test_input($_POST["joinDate"]);
    }
    if (empty($_POST["town"])) {
        $town = "";
    } else {
        $town = test_input($_POST["town"]);
    }
    if (empty($_POST["province"])) {
        $province = "";
    } else {
        $province = test_input($_POST["province"]);
    }
    if (empty($_POST["postalCode"])) {
        $postalcode = "";
    } else {
        $postalcode = test_input($_POST["postalCode"]);
    }

    if (empty($_POST["bankName"])) {
        $bankName = "";
    } else {
        $bankName = test_input($_POST["bankName"]);
    }
    if (empty($_POST["bankCode"])) {
        $bankCode = "";
    } else {
        $bankCode = test_input($_POST["bankCode"]);
    }

    if (empty($_POST["branchName"])) {
        $branchName = "";
    } else {
        $branchName = test_input($_POST["branchName"]);
    }
    if (empty($_POST["branchCode"])) {
        $branchCode = "";
    } else {
        $branchCode = test_input($_POST["branchCode"]);
    }
    if (empty($_POST["accountHolderName"])) {
        $accountHolderName = "";
    } else {
        $accountHolderName = test_input($_POST["accountHolderName"]);
    }
    if (empty($_POST["accountNumber"])) {
        $accountNumber = "";
    } else {
        $accountNumber = test_input($_POST["accountNumber"]);
    }
}
// get the new employeenumber
$newEmpNumber = getNewEmployeeNumber($conn);

$firstNameErr = $lastNameErr = $nicErr = $employeeNumberErr = $refNumberErr = $primaryNumberErr = $secondNumberErr = $addressErr = $joinDateErr = $townErr = $provinceErr = $postalcodeErr = $refNumberErr = $bankNameErr = $bankCodeErr = $branchNameErr = $branchCodeErr = $accountHolderNameErr = $accountNumberErr = "";
$firstName = $lastName = $nic = $employeeNumber = $refNumber = $primaryNumber = $secondNumber = $address = $joindate = $town = $province = $postalcode = $refNumber = $bankName = $bankCode = $branchName = $branchCode = $accountHolderName = $accountNumber = "";



try {
    insertEmployee($conn, $firstName, $lastName, $nic, $employeeNumber, $refNumber, $primaryNumber, $secondNumber, $town, $province, $postalcode, $accountNumber, $bankName, $bankCode, $branchName, $branchCode, $joindate, $address, $accountHolderName);
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
