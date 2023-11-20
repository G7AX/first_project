<?php
session_start();
include "functions.php";
$email = $_POST['email'];
$password = $_POST['password'];
$new_password = $_POST['new_password'];
$password_confirmation = $_POST['password_confirmation'];
$user = get_user($_GET['id']);

if (password_verify($password, $user['password']) == false) {
    $_SESSION['failed_message'] = 'Неверный пароль';
    header("Location: /users.php");
    exit;
}
if ($new_password != $password_confirmation) {
    $_SESSION['failed_message'] = 'Пароли не совпадают';
    header("Location: /users.php");
    exit;
}
if ($email != $user['email'] and !empty($new_password)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE `users` SET email = :email, password = :password WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $user['id'], 'email' => $email, 'password' => $hashed_password]);
}
if ($email != $user['email']) {
    $sql = "UPDATE `users` SET email = :email WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $user['id'], 'email' => $email]);
}
if (!empty($new_password)) {
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $sql = "UPDATE `users` SET password = :password WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $user['id'], 'password' => $hashed_password]);
}
