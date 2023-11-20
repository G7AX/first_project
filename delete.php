<?php
session_start();
include "functions.php";
$user = get_user($_GET['id']);
if (is_not_logged_in()) {
    header('Location: /page_login.php');
    $_SESSION['login_failed'] = 'Вы не авторизованы, <strong>доступ запрещён</strong>';
    exit;
}
if ($_SESSION['user']['role'] == 'user' and $_SESSION['user']['id'] != $user['id']) {
    header("Location: /users.php");
    $_SESSION['failed_message'] = '<strong>Уведомление!</strong> Доступ запрещён!';
    exit;
}
user_delete($_GET['id']);
if($_SESSION['user']['role'] == 'user'){
    session_unset();
    header("Location: /page_login.php");
    exit;
}
if ($_SESSION['user']['role'] == 'admin' and $_SESSION['user']['id'] == $_GET['id']) {
    session_unset();
    header("Location: /page_login.php");
    exit;
}
header("Location: /users.php");
exit;
?>