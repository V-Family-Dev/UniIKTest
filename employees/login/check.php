<?php
session_start();


require "../../DB/dbconfig.php";
require "../../functions/login/loginFunction.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST['login-username']) ? $_POST['login-username'] : '';
    $password = isset($_POST['login-password']) ? $_POST['login-password'] : '';
    $password = password($password);

    if (empty($username) || empty($password)) {

        echo json_encode(array('error' => 'Please fill all the fields', 'status' => 'error'));
    } else {
        if (checkUserLogin($conn, $username, $password) == "1") {
            $data = fetchUserDetails($conn, $username, $password);
            $_SESSION['emp_acc'] = true;
            $_SESSION['emp_id'] = $data['employee_no'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['emp_type'] = 1;
            $ulevel = 1;
            $data = array(
                "success" => "Login successful",
                "status" => "succ",
                "location" => $ulevel
            );
        } else {
            $data = array('error' => 'not user emp ');
            if (adminUserLogin($conn, $username, $password) == "1") {
                $data = fetchAdminDetails($conn, $username, $password);
                $_SESSION['admin_acc'] = true;
                $_SESSION['ad_id'] = $data['admin_id'];
                $_SESSION['ad_name'] = $data['user_name'];
                $_SESSION['admin_type'] = 2;
                $ulevel = 2;
                $data = array(
                    "success" => "Login successful",
                    "status" => "succ",
                    "location" => $ulevel
                );
            } else {
                $data = array('error' => 'Invalid admin username or password', 'status' => 'error');
            }
        }
        echo json_encode($data);
    }
}
