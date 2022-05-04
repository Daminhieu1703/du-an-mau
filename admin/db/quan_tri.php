<?php
require_once "./function.php";
session_start();
if (!isset($_SESSION['nhan_vien'])) {
    header("location: /du_an_mau/trang_chu/login.php");
}else if (isset($_GET['logout'])) {
    $dang_xuat = $_GET['logout'];
    if ($dang_xuat == 'dangxuat') {
        unset($_SESSION['nhan_vien']);
        header('Location:\du_an_mau\trang_chu\login.php');
    }
}
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">QUẢN TRỊ WEBSITE</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #b22830;">Danh Mục Quản Trị</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="\du_an_mau\admin\khach_hang\list_admin.php">Nhân Viên</a></li>
                    <li><a class="dropdown-item" href="\du_an_mau\admin\loai_hang\list.php">Loại Hàng</a></li>
                    <li><a class="dropdown-item" href="\du_an_mau\admin\khach_hang\list.php">Khách Hàng</a></li>
                    <li><a class="dropdown-item" href="\du_an_mau\admin\hang_hoa\list.php">Hàng Hóa</a></li>
                    <li><a class="dropdown-item" href="\du_an_mau\admin\binh_luan\list.php">Bình Luận</a></li>
                    <li><a class="dropdown-item" href="\du_an_mau\admin\thong_ke\list.php">Thống Kê</a></li>
                </ul>
            </li>
            <div class="dropdown text-end" style="margin-left:950px">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $_SESSION['nhan_vien']['img']; ?>" alt="Rỗng" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                <li><a class="dropdown-item" href="\du_an_mau\trang_chu\index.php">Quay Lại Trang Chủ</a></li>
                    <li><a class="dropdown-item" href="\du_an_mau\admin\db\quan_tri.php?logout=dangxuat">Đăng Xuất</a></li>
                </ul>
            </div>
        </ul>
        <br>
        <h1 style="text-align:center;color: #b22830;">CHÀO MỪNG NHÂN VIÊN <b><?= $_SESSION['nhan_vien']['ho_ten']?></b> ĐẾN VỚI TRANG QUẢN TRỊ</h1>
        <div class="card" style="width: 25rem;margin:0 0 300px 450px;">
            <img src="<?= $_SESSION['nhan_vien']['img']?>" class="card-img-top" alt="..." style="height:200px;width:200px;margin: 10px 0 0 100px;">
            <div class="card-body">
                <h5 class="card-title">Họ Và Tên: <?= $_SESSION['nhan_vien']['ho_ten']?></h5>
                <p class="card-text">Mã Số: <?= $_SESSION['nhan_vien']['ma_kh']?></p>
                <p class="card-text">Tên Tài Khoản: <?= $_SESSION['nhan_vien']['ten_tk']?></p>
                <p class="card-text">Giới Tính: <?= ($_SESSION['nhan_vien']['gioi_tinh'] == 1) ? "Nam" : "Nữ"?></p>
                <p class="card-text">Email: <?= $_SESSION['nhan_vien']['email']?></p>
                <p class="card-text">Số Điện Thoại: <?= $_SESSION['nhan_vien']['sdt']?></p>
                <p class="card-text">Vai Trò: <?= ($_SESSION['nhan_vien']['vai_tro']==2)? "Nhân Viên":"" ?></p>
                <p class="card-text">Kích Hoạt: <?= ($_SESSION['nhan_vien']['kich_hoat']==1)? "Mở":"" ?></p>
                <a href="\du_an_mau\admin\khach_hang\edit.php?id=<?= $_SESSION['nhan_vien']['ma_kh']?>" class="btn btn-danger">THAY ĐỔI</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>