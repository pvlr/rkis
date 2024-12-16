<?php

require_once 'connect.php';

session_start();

$login = $_POST['login'];
$password = md5($_POST['password']);

try {

    // Обращение в таблицу пользователей
    $response = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '" . $login . "'");
    $response = mysqli_fetch_all($response);

    foreach ($response as $item) {

        if ($item[2] === $password) {

            $_SESSION['user_id'] = $item[0];
            $_SESSION['full-access'] = false;
            header('Location: ../index.php');
            
            break;

        } else {

            header('Location: ../sign-in.html');
        }
    }


    // Обращение в таблицу администраторов
    $response = mysqli_query($connect, "SELECT * FROM `admins` WHERE `login` = '" . $login . "'");
    $response = mysqli_fetch_all($response);

    foreach ($response as $item) {

        if ($item[2] === $password) {

            $_SESSION['user_id'] = $item[0];
            $_SESSION['full-access'] = true;
            header('Location: ../index.php');

            break;
            
        } else {

            header('Location: ../sign-in.html');
        }
    }

} catch (\Throwable $th) {

    echo $th;

}
