
   <?php
    require "../../DB/dbconfig.php";
    require "../../functions/employee/employeesFunctions.php";

    //header('Content-Type: application/json');





    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $NIC = isset($_POST['nic']) ? $_POST['nic'] : '';
        $employee_no = isset($_POST['employee_no']) ? $_POST['employee_no'] : '';
        $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
        $whatsapp_no = isset($_POST['whatsapp_no']) ? $_POST['whatsapp_no'] : '';
        $address = isset($_POST['Address']) ? $_POST['Address'] : '';
        $postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
        $branchCode = isset($_POST['branchCode']) ? $_POST['branchCode'] : '';
        $accountNumber = isset($_POST['AccountNum']) ? $_POST['AccountNum'] : '';
        $accountHolderName = isset($_POST['accountHolderName']) ? $_POST['accountHolderName'] : '';
        $reference_id = isset($_POST['reference_id']) ? $_POST['reference_id'] : '';


        if (empty($first_name) || empty($last_name) || empty($NIC) || empty($employee_no) || empty($phone_no) ||  empty($address) || empty($postalCode)) {
            echo json_encode(array('error' => 'Please fill all the fields'));
        } else {

            $dataadd = insettable($conn, $first_name, $last_name, $NIC, $employee_no, $phone_no, $whatsapp_no, $address, $postalCode, $branchCode, $accountNumber, $accountHolderName, $reference_id);
            echo json_encode($dataadd);
        }
    }
