<?php


//insert emp data


function insertEmployee()
{
}

function insettable($conn, $first_name, $last_name, $nic, $employee_no, $phone_no, $whatsapp_no, $Address, $postalCode, $branchCode, $accountHolderName, $AccountNum, $reference_id)
{

    $first_name = test_input($first_name);
    $last_name = test_input($last_name);
    $nic = test_input($nic);
    $employee_no = test_input($employee_no);
    $phone_no = test_input($phone_no);
    $whastapp_no = test_input($whatsapp_no);
    $Address = test_input($Address);
    $postalCode = test_input($postalCode);
    $branchCode = test_input($branchCode);
    $accountHolderName = test_input($accountHolderName);
    $AccountNum = test_input($AccountNum);



    if ($reference_id == "") {
        $reference_id = NULL;
    }

    $sql = $conn->prepare("INSERT INTO `employee` (`employee_no`, `first_name`, `last_name`, `NIC`, `phone_no`, `whatsapp_no`, `BankCode`, `Address`, `postcode`, `AccountNum`, `holderName`, `reference_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssisssss", $employee_no, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branchCode, $Address, $postalCode, $AccountNum, $accountHolderName, $reference_id);
    $sql->execute();

    $lastId = $sql->insert_id;
    if ($sql->affected_rows > 0) {
        $password = password();
        if (adduser($conn, $employee_no)) {
            $result = array("status" => "success", "message" => "Employee added successfully", "employee_id" => $lastId);
        } else {
            $result = array("status" => "error", "message" => "Failed to add employee to uset table", "employee_id" => $lastId);
        }
    } else {
        $result = array("status" => "error", "message" => "Failed to add employee");
    }
    $sql->close();
    $conn->close();



    return $result;
}


//user table data add

function adduser($conn, $employee_no)
{
    $pass = password();
    $adddata = $conn->prepare("INSERT INTO `employee_login`(`employee_no`, `password`) VALUES (?,?)");
    $adddatarun = $adddata->bind_param("ss", $employee_no, $pass);
    $adddata->execute();
    if (createwallet($conn, $employee_no) > 0) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

//create wallet

function createwallet($conn, $employee_no)
{
    $adddata = $conn->prepare("INSERT INTO `wallet` (`employee_no`, `status`) VALUES (?, ?)");
    if ($adddata === false) {
        return false;
    }
    $statusValue = 1;

    $adddatarun = $adddata->bind_param("si", $employee_no, $statusValue);
    if ($adddatarun === false) {
        return false;
    }

    if (!$adddata->execute()) {
        return false;
    }

    return $conn->affected_rows;
}

// password
function password()
{
    $password = rand(100000, 999999);
    $password = hashs($password);
    return $password;
}
function hashs($password)
{
    $salt = 'amarabandurupasinghe';
    $hash = md5($salt . $password);

    for ($i = 0; $i < 1000; $i++) {
        $hash = md5($hash);
    }

    return $hash;
}


function adddatauser($conn, $employee_no)
{
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
