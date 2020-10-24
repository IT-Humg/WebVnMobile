<?php 
    require "../connectt.php";
?>

<html>
    <head>
        <title>Admin Test</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
        <h1 style="text-align: center;">Trang quản trị danh mục</h1>
        <div class="container">
            <form class="row my-3 input-group" action="quantri_danhmuct.php" method="POST">
                Tên danh mục: 
                <input type="text" name="tendm" class="ml-3"> 
                <input type="submit" name="insert" value ="Thêm mới">
            </form>

        
            <table class="table table-striped"> 
                <thead class="thead-light">
                    <tr>
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select = "select * from tbl_danhmuc";
                        $ketqua = mysqli_query($conn, $select);
                      
                        if(mysqli_num_rows($ketqua) > 0){
                            while ($row = mysqli_fetch_assoc($ketqua)){
                                echo "<tr>";
                                    echo "<td>".$row['Ma_DM']."</td>";
                                    echo "<td>".$row['Ten_DM']."</td>";
                                    echo "<td>".$row['Trang_Thai']."</td>";
                                    echo "<td>";
                                        echo "<a href='' class='btn btn-warning'>Cập nhật</a>";
                                        echo "<a href='' class='btn btn-danger'>Xoá</a>";
                                    echo "</td>";
                                echo "</tr>";
                            } 
                        } else {
                            echo "<h1>Không có dữ liệu<h1>";
                        }
                    ?>
                </tbody>
                
            </table>
        </div>
        
    </body>
</html>
<!-- 
mysqli_connect(severname, username, pass, dbname); Kết nối với database
mysqli_query($connect, $sql); thực hiện câu lệnh sql 

mysqli_num_rows($kq);  Đến số bản ghi trong biến kq
mysqli_fetch_assoc($kq); trỏ đến từng hàng của biến kq

$_POST[] $_GET[]
-->