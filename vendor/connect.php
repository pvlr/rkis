<?php

try {
    $connect = mysqli_connect('MySQL-8.0', 'root', '', 'rkis');
} catch (Exception $e) {
    echo "Error: $e";
}

