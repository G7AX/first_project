<?php
include 'functions.php';
session_start();
$email = $_POST['page_register_email_input'];
$password = $_POST['page_register_password_input'];
if (user_is_have($email) == true){
    $_SESSION['failed_message'] = '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.';
    header('Location: /page_register.php');
    exit;
}
else{
    user_register($email, $password);
    $_SESSION['registration_success'] = 'Регистрация успешна';
    header('Location: /page_login.php');
    exit;
}
exit;
?>