<?php 
    $severname = 'localhost';
    $username = 'root';
    $password = '';
    $namedb = 'webhumg';

    $conn = mysqli_connect($severname, $username, $password, $namedb);

    if (!$conn) {
        echo '<h2 style="text-align: center;">Lỗi kết nối!</h2>';
    }
    else {
        echo '<h2 style="color: #2ecc71; font-weight: 500; text-align: center;">Kết nối thành công!</h2>';
    }

    
?>
