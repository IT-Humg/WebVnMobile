<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $databasename = 'webhumg';

    // Kết nối với database: mysqli_connect
    $conn = mysqli_connect($servername, $username, $password, $databasename);

    if(!$conn) {
        echo('Lỗi kết nối SQL');
    } else {
        echo("<h1 style='color: red'>Kết nối thành công</h1>");
    }
?>