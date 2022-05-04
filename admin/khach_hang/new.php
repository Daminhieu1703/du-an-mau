<?php session_start(); ?>
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">ĐĂNG KÝ THÀNH VIÊN</h1>
        <form class="col-8 offset-2" method="POST" action="\du_an_mau\admin\khach_hang\execute.php" enctype="multipart/form-data">
                <div class="mt-3">
                    <label>TÊN KHÁCH HÀNG</label>
                    <input class="form-control" type="text" name="ten_tk">
                </div>
                <div class="mt-3">
                    <label>HỌ TÊN</label>
                    <input class="form-control" type="text" name="ho_ten">
                </div>
                <div class="mt-3">
                    <label>EMAIL</label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div class="mt-3">
                    <label>SỐ ĐIỆN THOẠI</label>
                    <input class="form-control" type="number" name="sdt">
                </div>
                <div class="mt-3">
                    <label>MẬT KHẨU</label>
                    <input class="form-control" type="text" name="mat_khau">
                </div>
                <div class="mt-3">
                    <label>KÍCH HOẠT</label>
                    <select name="kich_hoat" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn kích Hoạt</option>
                        <option value="1">Mở</option>
                        <option value="2">Khóa</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>VAI TRÒ</label>
                    <select name="vai_tro" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn vai trò</option>
                        <option value="1">Khách Hàng</option>
                        <option value="2">Nhân Viên</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>GIỚI TÍNH</label>
                    <select name="gioi_tinh" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn giới tính</option>
                        <option value="1">Nam</option>
                        <option value="2">Nữ</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>ẢNH</label>
                    <input class="form-control" type="file" name="img">
                </div>
                <br>
                <div class="d-grid gap-2 fw-bold text-danger text-center">
                <?php if (isset($_SESSION['error_check'])) {echo $_SESSION['error_check']; unset($_SESSION['error_check']);}?>
                    <button type="submit" class="btn btn-primary" name="them">THÊM</button>
                    <a href="\du_an_mau\admin\khach_hang\list.php" class="btn btn-danger">HỦY</a>
                </div>
            </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>