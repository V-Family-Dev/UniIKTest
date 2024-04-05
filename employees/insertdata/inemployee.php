
   <?php
    require "../../DB/dbconfig.php";
    //require "../../functions/employee/employeesFunctions.php";




    if ($_SERVER["REQUEST_METHOD"] === "POST") {


        // Collect POST data with sanitation
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $NIC = isset($_POST['nic']) ? $_POST['nic'] : '';
        $employee_no = isset($_POST['employee_no']) ? $_POST['employee_no'] : '';
        $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
        $whatsapp_no = isset($_POST['whatsapp_no']) ? $_POST['whatsapp_no'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : 'test'; // Using default 'test' for address
        $postcode = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
        $branchCode = isset($_POST['branchCode']) ? $_POST['branchCode'] : '';
        $AccountNum = isset($_POST['AccountNum']) ? $_POST['AccountNum'] : '';
        $holderName = isset($_POST['accountHolderName']) ? $_POST['accountHolderName'] : ''; // Corrected the key for accountHolderName
        $reference_id = isset($_POST['reference_id']) ? $_POST['reference_id'] : '';
        $bank_id = isset($_POST['bankSelect']) ? $_POST['bankSelect'] : '';




        $dataarra = array($first_name, $last_name, $NIC, $employee_no, $phone_no, $whatsapp_no, $branchCode, $postcode, $AccountNum, $holderName, $reference_id, $bank_id);
        //
        //
        // Log the POST data
        // Or, for testing purposes:
        echo '<pre>';
        print_r($dataarra);
        echo '</pre>';
        $data = insertEmployee($conn, $employee_no, $first_name, $last_name, $NIC, $phone_no, $whatsapp_no, $branchCode, $postcode, $AccountNum, $holderName, $reference_id, $bank_id);


        echo json_encode($data);
    }

    function insertEmployee($conn, $employee_no, $first_name, $last_name, $NIC, $phone_no, $whatsapp_no, $branchCode, $postcode, $AccountNum, $holderName, $reference_id, $bank_id)
    {
        $sql = $conn->prepare("INSERT INTO `employee` (`employee_no`, `first_name`, `last_name`, `NIC`, `phone_no`, `whatsapp_no`, `BankCode`,  `postcode`, `AccountNum`, `holderName`, `reference_id`, `bank_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($sql === false) {
            return array("status" => "error", "message" => "Failed to prepare statement");
        }

        $sql->bind_param("ssssssissssi", $employee_no, $first_name, $last_name, $NIC, $phone_no, $whatsapp_no, $branchCode, $postcode, $AccountNum, $holderName, $reference_id, $bank_id);
        $sql->execute();

        if ($sql->affected_rows > 0) {
            $lastId = $sql->insert_id;
            $sql->close();
            return array("status" => "success", "message" => "Employee added successfully", "employee_id" => $lastId);
        } else {
            $sql->close();
            return array("status" => "error", "message" => "Failed to add employee");
        }
    }











    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'sinsertEmployee') {
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $NIC = isset($_POST['nic']) ? $_POST['nic'] : '';
        $employee_no = isset($_POST['employee_no']) ? $_POST['employee_no'] : '';
        $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
        $whatsapp_no = isset($_POST['whatsapp_no']) ? $_POST['whatsapp_no'] : '';
        $address = isset($_POST['Address']) ? $_POST['Address'] : 'test address';
        $postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
        $branchCode = isset($_POST['branchCode']) ? $_POST['branchCode'] : '';
        $accountNumber = isset($_POST['AccountNum']) ? $_POST['AccountNum'] : '';
        $accountHolderName = isset($_POST['accountHolderName']) ? $_POST['accountHolderName'] : '';
        $reference_id = isset($_POST['reference_id']) ? $_POST['reference_id'] : '';
        $bank_id = isset($_POST['bankCode']) ? $_POST['bankCode'] : '';


        if (empty($first_name) || empty($last_name) || empty($NIC) || empty($employee_no) || empty($phone_no) ||  empty($address) || empty($postalCode)) {
            echo json_encode(array('error' => 'Please fill all the fields'));
        } else {

            $dataadd = insettable($conn, $bank_id, $branchCode, $first_name, $last_name, $NIC, $employee_no, $phone_no, $whatsapp_no, $address, $postalCode, $branchCode, $accountNumber, $accountHolderName, $reference_id);
            echo json_encode($dataadd);
        }
    }


    function insertEmployees()
    {
    }

    function insettable($conn, $bank_id, $branchCode, $first_name, $last_name, $nic, $employee_no, $phone_no, $whatsapp_no, $Address, $postalCode, $accountHolderName, $AccountNum, $reference_id)
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

        $$sql = $conn->prepare("INSERT INTO `employee` (`employee_no`, `first_name`, `last_name`, `NIC`, `phone_no`, `whatsapp_no`, `BankCode`, `Address`, `postcode`, `AccountNum`, `holderName`, `reference_id`, `bank_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($sql === false) {
            return array("status" => "error", "message" => "Failed to prepare statement");
        }
        $sql->bind_param("ssssssisssssi", $employee_no, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branchCode, $Address, $postalCode, $AccountNum, $accountHolderName, $reference_id, $bank_id);
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
