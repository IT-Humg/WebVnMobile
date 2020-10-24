<?php
    $username = 'admin';
    $password = '12234';
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if(isset($user) && isset($pass)){
        echo("xin Chào các bạn");
    }
?>

<form action="index.php" method="POST">
        User: <input type="text" name="user"> <br>
        Password: <input type="password" name="pass" style="margin-top: 10px">
        <input type="submit" value="Gửi">
</form>