<?php







//for admin login


//add last login date and time


// Check username
function adminUsername($conn, $username)
{
    $stmt = $conn->prepare("SELECT `admin_id` FROM `admin` WHERE `user_name`= ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0 ? "1" : "0";
}

// Check admin status
function adminUserStatus($conn, $username)
{
    $stmt = $conn->prepare("SELECT `admin_status` FROM `admin` WHERE `user_name` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['admin_status'] == 1 ? "1" : "0";
    } else {
        return "0";
    }
}

// Check admin login
function adminUserLogin($conn, $username, $password)
{
    if (adminUsername($conn, $username) == "1" && adminUserStatus($conn, $username) == "1") {
        $stmt = $conn->prepare("SELECT `admin_id` FROM `admin` WHERE `user_name` = ?  AND  `password` = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? "1" : "0";
    } else {
        return "0";
    }
}

// Fetch admin details

function fetchAdminDetails($conn, $username, $password)
{
    $stmt = $conn->prepare("SELECT `admin_id`, `user_name` FROM `admin` WHERE `user_name` = ?  AND  `password` = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
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






























// for employee login


// Check username
function checkUsername($conn, $username)
{
    $stmt = $conn->prepare("SELECT  `employee_no` FROM `employee_login` WHERE `employee_no`= ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0 ? "1" : "0";
}

// Check user status
function checkUserStatus($conn, $username)
{
    $stmt = $conn->prepare("SELECT `user_status` FROM `employee_login` WHERE `employee_no` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['user_status'] == 1 ? "1" : "0";
    } else {
        return "0";
    }
}



// Check user login
function checkUserLogin($conn, $username, $password)
{
    if (checkUsername($conn, $username) == "1" && checkUserStatus($conn, $username) == "1") {
        $stmt = $conn->prepare("SELECT `id` FROM `employee_login` WHERE `employee_no` = ? AND `password` = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? "1" : "0";
    } else {
        return "0";
    }
}

// Fetch user details
function fetchUserDetails($conn, $employee_no, $password)
{
    $stmt = $conn->prepare("SELECT `id`, `employee_no`, `password`, `login_type`, `user_status` FROM `employee_login` WHERE `employee_no` = ? AND `password` = ?");
    $stmt->bind_param("ss", $employee_no, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
