<?php
session_name("myappsession");

session_start();

function baseurl($slug)
{
    $url = "http://localhost/v%20family/origin/UniIKTest/";
    return $url . $slug;
}

if (isset($_SESSION['emp_type']) || isset($_SESSION['admin_type'])) {
    session_regenerate_id();

    if (isset($_SESSION['emp_type']) && $_SESSION['emp_type'] == 1) {
        header("Location:" . baseurl('Views/employees/index.php'));
        exit;
    }
    if (isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 2) {
        header("Location:" . baseurl('Views/admin/index.php'));
        exit;
    }
} else {
    header("Location:" . baseurl('Views/Login/Login.php'));
    exit;
}
