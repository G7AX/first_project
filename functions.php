<?php
function connect_db()
{
    $host = "127.0.0.1";
    $db = "project";
    $user = "root";
    $password = "";
    return new PDO("mysql:host=$host;dbname=$db", $user, $password);
}
function get_users()
{
    $sql = "SELECT * FROM users";
    $statement = connect_db()->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
} //Получение всех пользователей со всеми данными
function get_user($id)
{
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}//Получение всех данных пользователя по id
function edit_user($id, $name, $job, $phone_number, $location){
    $sql = "UPDATE `users` SET `name` = :name, job = :job, phone_number = :phone_number, `location` = :location WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $id,'name' => $name, 'job' => $job, 'phone_number' => $phone_number, 'location' => $location]);
}
function user_is_have($email)
{
    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch(PDO::FETCH_ASSOC);
} //Проверка на наличие пользователя в базе по email'у
function user_register($email, $password)
{
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
} //Регистрация пользователя
function user_logged_info($email)
{
    $sql = "SELECT `id`, `role` FROM users WHERE email = :email";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch(PDO::FETCH_ASSOC);
} //Получение роли и id залогиненного пользователя
function user_delete($id)
{
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
} //удаление пользователя по id
function userpicture_create($image)
{
    $images_folder = "D:\\programs\\ospanel\\domains\\project\\img\\userpictures\\";
    $image_path = $image['tmp_name'];
    $type = new SplFileInfo($image['name']);
    $type = ($type->getExtension());
    $unique_name = uniqid("") . '.' . $type;
    move_uploaded_file($image_path, $images_folder . $unique_name);
    return $unique_name;
}
function user_create($email, $password, $name, $status, $job, $phone_number, $userpicture, $location, $vkontakte, $telegram, $instagram)
{
    $sql = "INSERT INTO users (`email`, `password`, `name`, `status`, `job`, `phone_number`, `userpicture`, `location`, `vkontakte`, `telegram`, `instagram`) VALUES (:email, :password, :name, :status, :job, :phone_number, :userpicture, :location, :vkontakte, :telegram, :instagram)";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password, 'name' => $name, 'status' => $status, 'job' => $job, 'phone_number' => $phone_number, 'userpicture' => $userpicture, 'location' => $location, 'vkontakte' => $vkontakte, 'telegram' => $telegram, 'instagram' => $instagram]);
}
function set_status($id, $status)
{
    $sql = "UPDATE `users` SET `status` = :status WHERE id = :id";
    $statement = connect_db()->prepare($sql);
    $statement->execute(['id' => $id, 'status' => $status]);
}
function is_logged_in(){
    return isset($_SESSION['user']);
}
function is_not_logged_in()
{
    return !is_logged_in();
}