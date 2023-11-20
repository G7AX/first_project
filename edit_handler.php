<?php 
session_start();
include "functions.php";
$id = $_GET['id'];
$name = $_POST['name'];
$job = $_POST['job'];
$phone_number = $_POST['phone_number'];
$location = $_POST['location'];


edit_user($id, $name, $job, $phone_number, $location);
header("Location: /users.php");
$_SESSION['success_message'] = 'Профиль обновлён.';
exit;
?>