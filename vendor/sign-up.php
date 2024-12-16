<?php

require_once('connect.php');

$login = $_POST['login'];
$password = md5($_POST['password']);

try {

    mysqli_query($connect, "INSERT INTO `users` (`login`, `password`) VALUES ('" . $login . "', '" . $password . "')");
    header('Location: ../index.php');

} catch (Exception $e) {

    echo "Error: $e";
    
}
