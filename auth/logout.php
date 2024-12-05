<?php
// Bắt đầu session
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/project_ttcsn/includes/connect.php';

session_unset(); 
session_destroy(); 
header("Location: http://localhost/project_ttcsn/auth/login.php");
exit;
?>
