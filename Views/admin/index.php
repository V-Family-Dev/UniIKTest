<?php
require "../../include/adminauth.php";

?>

<style>
    .link {
        margin-top: 20px;
        text-align: center;
        font-size: 30px;
    }

    .link a {
        display: block;
        margin-bottom: 10px;
        color: blue;
        text-decoration: none;
    }

    .link a:hover {
        color: red;
    }
</style>

<div class="link">
    <h2>User </h2>
    <a href="empRegistration.php">Add emp</a>
    <a href="search_emp.php">Search emp</a>
    <a href="adduser.php">User Management</a>
</div>

<div class="link">
    <h2>message </h2>
    <a href="send_push.php">Push</a>
    <a href="send_sms.php">SMS</a>

</div>