<?php
    require("../connect.php");
    //insert data
    if(isset($_POST["insert"]))
    {
        $ten_dm = $_POST["tendm"];
        $sql_insert = "insert into tbl_danhmuc(Ten_DM,Trang_Thai) values(N'$ten_dm',1)";
        if(mysqli_query($conn,$sql_insert))
        {
            echo "insert dữ liệu thành công";
            //điều hướng trang tránh insert cùng 1 giá trị nhiêu làn khi F5 website
            header("Location:mana_danhmuc.php");
        }
        else
            echo "insert dữ liệu thất bại" . mysqli_error($conn);
    }

    //xoá dữ liệu
    if(isset($_GET["task"]) && $_GET["task"]=="delete")
    {
        $ma_dm = $_GET["id"];
        $sql_delete = "delete from tbl_danhmuc where Ma_DM = ". $ma_dm;
        if(mysqli_query($conn,$sql_delete))
        {
            echo "xoá thành công mã danh muc". $ma_dm;
        }
        else
            echo "xoá dữ liệu thất bại" . mysqli_error($conn);
    }
    //cập nhật dữ liệu
    if(isset($_POST["update"]))
    {
        $ma_dm = $_POST["ma_ud"];
        $sql_update = "update tbl_danhmuc set Ten_DM = N'".$_POST["update_tendm"]."' where Ma_DM = ". $ma_dm;
        if(mysqli_query($conn,$sql_update))
        {
            echo "sửa thành công mã danh muc". $ma_dm;
        }
        else
            echo "sửa dữ liệu thất bại" . mysqli_error($conn);
    }
    //upload hình ảnh
    
    if(isset($_POST["up_image"]))
    {
        $target_dir = "images_upload/";
        $target_file = $target_dir . basename($_FILES["tai_anh"]["name"]);
        
        if (move_uploaded_file($_FILES["tai_anh"]["tmp_name"], $target_file)) 
        {
            echo "upload file thành công";
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <h1 style="text-align:center">Trang quản trị danh mục</h1>
            <!--insert data-->
            <div class="row">
                <form action="mana_danhmuc.php" method="post">
                    Nhập vào tên danh mục:
                    <input type="text" name="tendm">
                    <input type="submit" name="insert" value="Thêm mới">
                </form>
            </div>
            <!--upload hình ảnh-->
            <div class="row">
                <form action="mana_danhmuc.php" method="post" enctype="multipart/form-data">
                    Bạn chọn hình ảnh ở đây
                    <input type="file" name="tai_anh">
                    <input type="submit" value="Upload Ảnh" name="up_image">
                </form>
            </div>
            <!--show data-->
            <div class="row">
                <table class="table table-striped">
                    <!--tiêu đề bảng-->
                    <tr>
                        <th>Mã Danh Mục</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    <!--hiển thị dữ liệu-->
                    <?php
                        //khởi tạo biến truy vấn csdl
                        $sql_select = "select * from tbl_danhmuc";
                        //đổ dữ liệu vào biến kết quả
                        $ketqua = mysqli_query($conn,$sql_select);
                        //kiểm tra xem dữ liệu có trống hay không
                        if(mysqli_num_rows($ketqua)>0)
                        {
                            //sử dụng vòng lặp while để duyệt mảng kết quả
                            while($row = mysqli_fetch_assoc($ketqua))
                            {
                                echo "<tr>";
                                echo "<td>".$row["Ma_DM"]."</td>";
                                //kiểm tra update
                                if(isset($_GET["task"]) && $_GET["task"]=="update")
                                {
                                    if($_GET["id"]==$row["Ma_DM"])
                                    {
                                        echo "<form method='post' action='mana_danhmuc.php'><td>";
                                        echo "<input type='text' name='update_tendm' value='".$row["Ten_DM"]."'>";
                                        echo "</td>";
                                        echo "<td>".$row["Trang_Thai"]."</td>";
                                        echo "<input type='hidden' name='ma_ud' value='".$row["Ma_DM"]."'>";
                                        echo "<td>";
                                        echo "<input type='submit' class='btn btn-primary' value='Cập nhật' name='update'>";
                                        
                                        echo "</td></form>";
                                    }
                                    else
                                    {
                                        echo "<td>".$row["Ten_DM"]."</td>";
                                        echo "<td>".$row["Trang_Thai"]."</td>";
                                        echo "<td>";
                                        echo "<a href='mana_danhmuc.php?task=update&id=".$row["Ma_DM"]."' class='btn btn-warning'>Cập nhật</a>";
                                        echo "<a href='mana_danhmuc.php?task=delete&id=".$row["Ma_DM"]."' class='btn btn-danger'>Xoá</a>";
                                        echo "</td>";
                                    }
                                }
                                else
                                {
                                    echo "<td>".$row["Ten_DM"]."</td>";
                                    echo "<td>".$row["Trang_Thai"]."</td>";
                                    echo "<td>";
                                    echo "<a href='mana_danhmuc.php?task=update&id=".$row["Ma_DM"]."' class='btn btn-warning'>Cập nhật</a>";
                                    echo "<a href='mana_danhmuc.php?task=delete&id=".$row["Ma_DM"]."' class='btn btn-danger'>Xoá</a>";
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            echo "bảng không chứa dữ liệu";
                        }
                    ?>
                    <!--<tr>
                        <td>1</td>
                        <td>Tin tức</td>
                        <td>1</td>
                        <td><a href='#' class='btn btn-warning'>Cập nhật</a><a href='#' class='btn btn-danger'>Xoá</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Thông báo</td>
                        <td>1</td>
                        <td><a href='#' class='btn btn-warning'>Cập nhật</a><a href='#' class='btn btn-danger'>Xoá</a></td>
                    </tr>-->
                </table>
            </div>
        </div>
    </body>
</html>