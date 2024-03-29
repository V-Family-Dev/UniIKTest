<?php

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");



require "../DB/dbconfig.php";
require "../functions/employee/employeesFunctions.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <title>Document</title>
    <style>
        input[readonly],
        textarea[readonly] {
            background-color: #e9e9e9;
            /* Light grey background */
            color: #696969;
            /* Darker text */
            /* Other styles as needed */
        }
    </style>
</head>