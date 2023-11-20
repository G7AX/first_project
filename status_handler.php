<?php
session_start();
include 'functions.php';
$id = $_GET['id'];
$status = $_POST['status'];
set_status($id, $status);
$_SESSION['success_message'] = 'Профиль обновлён.';
header("Location: /users.php");
exit;