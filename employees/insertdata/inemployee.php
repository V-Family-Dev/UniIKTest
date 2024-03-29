
   <?php
    require "../../DB/dbconfig.php";
    require "../../functions/employee/employeesFunctions.php";

    //header('Content-Type: application/json');





    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        




        if (empty($first_name) || empty($last_name)) {
            echo 'file is empty';
        } else {
            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name
            );

            echo json_encode($data);
        }
    }
