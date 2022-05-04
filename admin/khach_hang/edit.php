<?php
require_once "./../db/function.php";
session_start();
$ma_kh =  $_GET['id'];
$sql = "SELECT * FROM khach_hang WHERE ma_kh = ?";
$data = pdo_query_one($sql,$ma_kh);
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">CẬP NHẬT TÀI KHOẢN</h1>
        <form class="col-8 offset-2" method="POST" action="\du_an_mau\admin\khach_hang\execute.php" enctype="multipart/form-data">
                <input type="hidden" name="ma_kh" value="<?php echo $ma_kh ?>">
                <div class="mt-3">
                    <label>MÃ KHÁCH HÀNG</label>
                    <input class="form-control" type="text" name="ma_kh" value="<?php echo $ma_kh ?>" disabled>
                </div>
                <div class="mt-3">
                    <label>TÊN TÀI KHOẢN</label>
                    <input class="form-control" type="text" name="ten_tk" value="<?= $data['ten_tk']?>">
                </div>
                <div class="mt-3">
                    <label>HỌ TÊN</label>
                    <input class="form-control" type="text" name="ho_ten" value="<?= $data['ho_ten']?>">
                </div>
                <div class="mt-3">
                    <label>EMAIL</label>
                    <input class="form-control" type="email" name="email" value="<?= $data['email']?>">
                </div>
                <div class="mt-3">
                    <label>SỐ ĐIỆN THOẠI</label>
                    <input class="form-control" type="number" name="sdt" value="<?= $data['sdt']?>">
                </div>
                <div class="mt-3">
                    <label>MẬT KHẨU</label>
                    <input class="form-control" type="text" name="mat_khau" value="<?= $data["mat_khau"]?>">
                </div>
                <div class="mt-3">
                    <label>KÍCH HOẠT</label>
                    <select name="kich_hoat" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn kích Hoạt</option>
                        <option value="1" <?= $data["kich_hoat"] == 1 ? "selected" : "" ?>>Mở</option>
                        <option value="2"  <?= $data["kich_hoat"] == 2 ? "selected" : "" ?>>Khóa</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>VAI TRÒ</label>
                    <select name="vai_tro" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn vai trò</option>
                        <option value="1" <?= $data["vai_tro"] == 1 ? "selected" : "" ?>>Khách Hàng</option>
                        <option value="2" <?= $data["vai_tro"] == 2 ? "selected" : "" ?>>Nhân Viên</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>GIỚI TÍNH</label>
                    <select name="gioi_tinh" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn giới tính</option>
                        <option value="1" <?= $data["gioi_tinh"] == 1 ? "selected" : "" ?>>Nam</option>
                        <option value="2" <?= $data["gioi_tinh"] == 2 ? "selected" : "" ?>>Nữ</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>ẢNH</label>
                    <div style="display:flex;">
                        <input class="form-control" type="file" name="image">
                        <input type="hidden" name="img" value="<?php echo $data['img'] ?>">
                        <img src="<?=$data['img'] ?>" alt="" style="width:40px;height:38px;">
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 fw-bold text-danger text-center">
                <?php if (isset($_SESSION['error_check'])) {echo $_SESSION['error_check']; unset($_SESSION['error_check']);}?>
                    <button type="submit" class="btn btn-primary" name="sua">SỬA</button>
                    <a href="\du_an_mau\admin\khach_hang\list.php" class="btn btn-danger">HỦY</a>
                </div>
            </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>