<?php
session_start();
include "functions.php";

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$name = $_POST['name'];
$status = $_POST['status'];
$job = $_POST['job'];
$phone_number = $_POST['phone_number'];
$userpicture = $_FILES['userpicture'];
$location = $_POST['location'];
$vkontakte = $_POST['vkontakte'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];
user_is_have($email);
if (user_is_have($email) == true) {
    $_SESSION['failed_message'] = '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.';
    header('Location: /users.php');
    exit;
}
if (!empty($userpicture)){
    $userpicture = userpicture_create($userpicture);
}

user_create($email, $password, $name, $status, $job, $phone_number, $userpicture, $location, $vkontakte, $telegram, $instagram);
$_SESSION['success_message'] = 'Пользователь добавлен.';
header("Location: /users.php");
exit;
?>