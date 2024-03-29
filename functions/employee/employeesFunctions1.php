<?php

// generate new employeenumber
function getNewEmployeeNumber($conn)
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


function geterror($first_name, $last_name, $nic, $employee_no, $reference_id, $phone_no, $whatsapp_no, $Address, $postalCode, $branchCode, $accountHolderName, $AccountNum)
{
    if (empty($first_name)) {
        return array("status" => "error", "message" => "First Name is required");
    }
    if (empty($last_name)) {
        return array("status" => "error", "message" => "Last Name is required");
    }
    if (empty($nic)) {
        return array("status" => "error", "message" => "NIC is required");
    }
    if (empty($employee_no)) {
        return array("status" => "error", "message" => "Employee Number is required");
    }
    if (empty($reference_id)) {
        return array("status" => "error", "message" => "Reference ID is required");
    }
    if (empty($phone_no)) {
        return array("status" => "error", "message" => "Phone Number is required");
    }
    if (empty($whatsapp_no)) {
        return array("status" => "error", "message" => "Whatsapp Number is required");
    }
    if (empty($Address)) {
        return array("status" => "error", "message" => "Address is required");
    }
    if (empty($postalCode)) {
        return array("status" => "error", "message" => "Postal Code is required");
    }
    if (empty($branchCode)) {
        return array("status" => "error", "message" => "Branch Code is required");
    }
    if (empty($accountHolderName)) {
        return array("status" => "error", "message" => "Account Holder Name is required");
    }
    if (empty($AccountNum)) {
        return array("status" => "error", "message" => "Account Number is required");
    }

    return array("status" => "success", "message" => "All fields are valid");
}


function getempId($conn)
{
    $sql = "SELECT employee_no FROM employee";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $empNumber = [];
        while ($row = $result->fetch_assoc()) {
            $empNumber[] = $row;
        }
    }

    return $empNumber;
}




// validation and Sanitization 
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// add new emp
function insertEmployee($conn, $firstName, $lastName, $nic, $employeeNumber, $refNumber, $primaryNumber, $secondNumber, $accountNum, $branchCode, $joindate, $address)
{
    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO employee (first_name, last_name, NIC, employee_no,reference_id,phone_no,whastapp_no,AccountNum,BankCode,joined_date, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if preparation is successful
    if ($stmt === false) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssiisiss", $firstName, $lastName, $nic, $employeeNumber, $refNumber, $primaryNumber, $secondNumber, $accountNum, $branchCode, $joindate, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// get all the emp details
function getAllEmployees($conn)
{
    $sql = "SELECT * FROM employee";
    $result = $conn->query($sql);

    $employees = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        $result->free();
    } else {
        // Handle error - the query failed
    }

    $conn->close();
    return $employees;
}

// delete the emp
function deleteEmployee($id, $conn)
{
    $sql = "UPDATE employee SET EmpStatus = 0 WHERE idEmployees = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        return true; // Indicate success
    } else {
        // Handle error - failed to prepare statement
        return false; // Indicate failure
    }
}

function gellAllbanckCode($conn)
{
    $sql = "SELECT bankcode,bankname from bankcodes;";

    $result = $conn->query($sql);
    $bankDetails = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bankDetails[] = $row;
        }
    }

    return $bankDetails;
}

function gellAllbranchCode($conn)
{
    $sql = "SELECT branchcode,branchname from branchcodes;";

    $result = $conn->query($sql);
    $branchcodes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $branchcodes[] = $row;
        }
    }

    return $branchcodes;
}
