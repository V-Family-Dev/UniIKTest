<?php
session_start();

if (isset($_SESSION['emp_type']) || isset($_SESSION['admin_type'])) {
    if (isset($_SESSION['emp_type']) && $_SESSION['emp_type'] == 1) {
        header("Location: employees/index.php");
        exit;
    }
    if (isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 2) {
        header("Location: admin/");
        exit;
    }
} else {
    header("Location: ../Login/Login.php");
    exit;
}
