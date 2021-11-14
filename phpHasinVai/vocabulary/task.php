<?php
include_once("config.php");
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    throw new Exception("Cannot Connect To Database");
} else {
    $action = $_POST['action'] ?? "";

    if (! $action) {
        header("Location: index.php");
        die();
    } else {
        if ("register" == $action) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($email && $password) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO `users`(`email`, `password`) VALUES ('{$email}','{$hash}')";
                mysqli_query($connection,$query);
                header('Location: index.php?added=true');
            }
        }
    }
}
