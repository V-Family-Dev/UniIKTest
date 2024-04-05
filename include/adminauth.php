<?php
session_start();

if (!isset($_SESSION['admin_type']) && $_SESSION['admin_type'] != 2) {
}
