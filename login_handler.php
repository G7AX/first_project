<?php
session_start();
include "functions.php";
$email = $_POST["page_login_email_input"];
$password = $_POST["page_login_password_input"];
if (user_is_have($email) == true && password_verify($password, user_is_have($email)['password']) == true){
    header("Location: /users.php");
    $_SESSION['user'] = user_logged_info($email);
    exit;
}
else if(empty($email) or empty($password)){
    header("Location: /page_login.php");
    exit;
}
else{
    header("Location: /page_login.php");
    $_SESSION['login_failed'] = 'Неверный логин или пароль';
    exit;
}
