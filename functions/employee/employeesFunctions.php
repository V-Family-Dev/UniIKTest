<?php


//insert emp data

function insettable($conn, $data)
{

    $first_name = test_input($data['first_name']);
    $last_name = test_input($data['last_name']);
    $nic = test_input($data['nic']);
    $employee_no = test_input($data['employee_no']);
    $reference_id = test_input($data['reference_id']);
    $phone_no = test_input($data['phone_no']);
    $whastapp_no = test_input($data['whastapp_no']);
    $Address = test_input($data['Address']);
    $postalCode = test_input($data['postalCode']);
    $branchCode = test_input($data['branchCode']);
    $accountHolderName = test_input($data['accountHolderName']);
    $AccountNum = test_input($data['AccountNum']);


    $valid = geterror($first_name, $last_name, $nic, $employee_no, $phone_no, $whastapp_no, $Address, $postalCode, $branchCode, $accountHolderName, $AccountNum);
    if ($reference_id == "") {
        $reference_id = NULL;
    }

    if ($valid['status'] === 'error') {
        return $valid;
    }
    $sql = $conn->prepare("INSERT INTO `employee`( `employee_no`, `first_name`, `last_name`, `NIC`, `phone_no`, `whastapp_no`, `BankCode`, `Address`, `postcode`, `AccountNum`, `holderName`,`reference_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param("sssssssissssss", $employee_no, $first_name, $last_name, $nic, $phone_no, $whastapp_no, $branchCode, $Address, $postalCode, $AccountNum, $accountHolderName, $reference_id);
    $sql->execute();
    $lastId = $sql->insert_id;
    if ($sql->affected_rows > 0) {
        $result = array("status" => "success", "message" => "Employee added successfully");
    } else {
        $result = array("status" => "error", "message" => "Failed to add employee");
    }
    $sql->close();
    $conn->close();



    return $result;
}

function geterror($first_name, $last_name, $nic, $employee_no,  $phone_no, $whatsapp_no, $Address, $postalCode, $branchCode, $accountHolderName, $AccountNum)
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


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function provinces($conn)
{
    $sql = "SELECT * FROM provinces";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $provinces[] = $row;
        }
    }

    return $provinces;
}




function getlocation($conn)
{
    $sql = "SELECT p.name_en,p.id, d.name_en,d.id,c.id, c.name_en,c.postcode FROM cities AS c INNER JOIN districts AS d ON c.district_id=d.id INNER JOIN provinces AS p ON p.id=d.province_id ORDER BY p.name_en, d.name_en, c.name_en";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $location[] = $row;
        }
    }

    return $location;
}
















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
