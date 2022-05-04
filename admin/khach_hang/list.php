<?php
require_once "./../db/function.php";
$sql = "SELECT * FROM khach_hang WHERE vai_tro = 1";
$getdata = pdo_query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">DANH SÁCH TÀI KHOẢN KHÁCH HÀNG</h1>
       <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>MÃ KHÁCH HÀNG</th>
                            <th>TÊN KHÁCH HÀNG</th>
                            <th>HỌ VÀ TÊN</th>
                            <th>EMAIL</th>
                            <th>SỐ ĐIỆN THOẠI</th>
                            <th>MẬT KHẨU</th>
                            <th>GIỚI TÍNH</th>
                            <th>KÍCH HOẠT</th>
                            <th>VAI TRÒ</th>
                            <th>ẢNH</th>
                            <th><a href="\du_an_mau\admin\khach_hang\new.php" class="btn btn-success">THÊM</a></th>
                            <th><a href="\du_an_mau\admin\db\quan_tri.php" class="btn btn-secondary">QUAY LẠI</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                                <td><?=$value['ma_kh'] ?></td>
                                <td><?=$value['ten_tk'] ?></td>
                                <td><?=$value['ho_ten'] ?></td>
                                <td><?=$value['email'] ?></td>
                                <td><?=$value['sdt'] ?></td>
                                <td><?=$value['mat_khau'] ?></td>
                                <td><?=($value['gioi_tinh'] == 1)?"Nam":"Nữ"?></td>
                                <td><?=($value['kich_hoat'] == 1)?"Mở":"Khóa"?></td>
                                <td><?=($value['vai_tro'] == 1)?"Khách hàng":"Nhân Viên"?></td>
                                <td><img src="<?=$value['img'] ?>" style="width:50px; height:50px" alt=""></td>
                                <td><a href="\du_an_mau\admin\khach_hang\edit.php?id=<?=$value['ma_kh'] ?>" class="btn btn-primary">SỬA</a></td>
                                <td><a href="\du_an_mau\admin\khach_hang\execute.php?id=<?=$value['ma_kh'] ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa chứ ?')">XÓA</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
            </table>
    </div>
</body>
</html>