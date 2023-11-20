<?php
session_start();
include "functions.php";
$id = $_GET['id'];
$image = $_FILES['userpicture'];
$path = userpicture_create($image);
$sql = 'UPDATE users SET `userpicture` = :userpicture WHERE id = :id';
$statement = connect_db()->prepare($sql);
$statement->execute(['userpicture' => $path, 'id' => $id]);
$_SESSION['success_message'] = 'Профиль обновлён.';
header("Location: /users.php");
exit;
// 'UPDATE `users` SET `userpicture` = '655849e25ecac.jpg' WHERE `users`.`id` = 9;'