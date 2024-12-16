<?php

require_once('connect.php');

$brand = $_POST['brand'];
$model = $_POST['model'];
$color = $_POST['color'];
$condition = $_POST['condition'];
$maintenance = $_POST['maintenance-date'];
$fuel = $_POST['fuel-consumption'];

// Проверяем, был ли загружен файл
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file-input'])) {

    $uploadDir = '../img/'; // Папка для загрузки файлов (убедитесь, что она существует и имеет права на запись)
    $file = $_FILES['file-input'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        die('Недопустимый тип файла.');
    }

    $maxFileSize = 5 * 1024 * 1024; // 2 MB
    if ($file['size'] > $maxFileSize) {
        die('Файл слишком большой.');
    }

    // Проверяем наличие ошибок при загрузке
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Ошибка при загрузке файла.');
    }

    // Генерируем уникальное имя файла
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION); // Получаем расширение файла
    $uniqueFileName = uniqid('photo_', true) . '.' . $fileExtension;

    // Путь для сохранения файла
    $filePath = $uploadDir . $uniqueFileName;

    // Перемещаем загруженный файл в целевую папку
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "Файл успешно загружен: $uniqueFileName";

        // Здесь вы можете сохранить $uniqueFileName в базу данных
    } else {
        die('Ошибка при сохранении файла.');
    }

} else {

    die('Файл не был загружен.');
}


try {

    mysqli_query($connect, "INSERT INTO cars (`brand`, `model`, `color`, `condition`, `maintenance_date`, `fuel_consumption`, `photo_url`) VALUES ('" . $brand . "', '" . $model . "', '" . $color . "', '" . $condition . "', '" . $maintenance . "', '" . $fuel . "', '" . $uniqueFileName . "')");
    header('Location: ../index.php');

} catch (Exception $e) {

    echo "Error: $e";
    
}
