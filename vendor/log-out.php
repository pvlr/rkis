<?php

session_start();

unset($_SESSION['user_id']);
unset($_SESSION['full-access']);

header('Location: ../index.php');
