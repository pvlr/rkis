<?php

if ( $_SERVER['REQUEST_METHOD'] === 'DELETE' ) {
    
    // $id = intval(file_get_contents("php://input"));
    $input = json_decode(file_get_contents("php://input"), true);
    $id = intval($input['id']);
    $imagePath = '../' . $input['image'];

    if ( $id > 0 ) {
        
        $db_host = 'MySQL-8.0';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'rkis';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        
        if ( $conn -> connect_error ) {

            die ( json_encode(['success' => false, 'error' => 'Ошибка подключения к базе данных']) );
        }
        
        $sql = "DELETE FROM cars WHERE id = $id";

        if ( $conn -> query($sql) === TRUE ) {
            
            if ( file_exists($imagePath) ) {

                if ( unlink($imagePath) ) {

                    echo json_encode(['success' => true]);

                } else {

                    echo json_encode(['success' => false, 'error' => 'Ошибка удаления файла изображения']);
                }

            } else {

                echo json_encode(['success' => true, 'warning' => 'Файл изображения не найден']);
            }

        } else {

            echo json_encode(['success' => false, 'error' => $conn->error]);
        }

        $conn->close();

    } else {

        echo json_encode(['success' => false, 'error' => 'Некорректный ID']);
    }

} else {
    
    echo json_encode(['success' => false, 'error' => 'Неподдерживаемый метод']);
}
?>
