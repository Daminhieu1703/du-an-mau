<?php
require_once "./../admin/db/function.php";
require_once "./dao.php";
 session_start();
$sql = "SELECT * FROM hang_hoa";
$getdata = pdo_query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="\du_an_mau\html_css\css\header.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
        <header>
            <section class="logo">
                <a href=""><img src="img/logo.png" alt=""></a>
            </section>
            <section class="menu-search">
                <section class="search">
                    <form action="\du_an_mau\trang_chu\search.php" method="POST">
                        <input type="text" placeholder="Tìm kiếm" name="keyword">
                        <button type="submit" name="search"><i class="fas fa-search"></i></button>
                    </form>
                    <a href="" class="flag"><img src="\du_an_mau\html_css\img\conuocanh.png" alt=""></a>
                    <a href="" class="flag"><img src="\du_an_mau\html_css\img\covietnam.png" alt=""></a>
                    <?php if (isset($_SESSION['khach_hang']) || isset($_COOKIE['ten_tk']) && isset($_COOKIE['mat_khau'])){ ?> 
                      <?php if (isset( $_SESSION['khach_hang']['ma_kh'])) {
                          $ma_kh = $_SESSION['khach_hang']['ma_kh'];
                          $profile = select_kh_byID($ma_kh);
                      }else {
                          $ten_tk = $_COOKIE['ten_tk'];
                          $khach_hang = select_kh_byTenTk($ten_tk);
                          $ma_kh = $khach_hang['ma_kh'];
                          $profile = select_kh_byID($ma_kh);
                      }
                      ?>
                      <a href="\du_an_mau\trang_chu\cart.php" class="cart"><i class="fas fa-cart-plus"></i></a>
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?=$profile['img']?>" alt="Rỗng" width="30" height="30" class="rounded-circle" style="margin-left:10px;">
                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                                <li><a class="dropdown-item" href="\du_an_mau\trang_chu\login.php">Hồ Sơ</a></li>
                                <li><a class="dropdown-item" href="\du_an_mau\trang_chu\dao.php?logout=dangxuat_kh">Đăng Xuất</a></li>
                            </ul>
                        </div>
                     <?php }elseif(isset($_SESSION['nhan_vien'])){ ?>
                      <div class="dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= $_SESSION['nhan_vien']['img']?>" alt="Rỗng" width="30" height="30" class="rounded-circle" style="margin-left:10px;">
                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                                <li><a class="dropdown-item" href="\du_an_mau\admin\db\quan_tri.php">Quản Trị</a></li>
                                <li><a class="dropdown-item" href="\du_an_mau\admin\db\quan_tri.php?logout=dangxuat">Đăng Xuất</a></li>
                            </ul>
                        </div>
                     <?php }else{ ?>
                          <a href="\du_an_mau\trang_chu\cart.php" class="cart"><i class="fas fa-cart-plus"></i></a>
                          <a href="\du_an_mau\trang_chu\login.php" class="user"><i class="fas fa-user"></i></a>
                     <?php }?>
                </section>
                <nav class="menu-all">
                    <ul class="menu-1">
                        <li><a href="\du_an_mau\trang_chu\index.php">TRANG CHỦ</a></li>
                        <li><a href="\du_an_mau\trang_chu\danh_muc.php">THỰC ĐƠN</a>
                          <nav class="menu-con">
                            <ul>
                              <li><a href="/du_an_mau/trang_chu/danh_muc.php?id=48">CÀ PHÊ</a></li>
                              <?php foreach ($getdata as $value) {?>
                                <?php if ($value['ma_loai'] == 48) {?>
                                  <li><a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value['ma_hh'] ?>"><?= $value['ten_hh'] ?></a></li>
                                <?php }?>
                              <?php } ?>
                            </ul>
                            <ul>
                              <li><a href="/du_an_mau/trang_chu/danh_muc.php?id=49">FREEZE</a></li>
                              <?php foreach ($getdata as $value) {?>
                                <?php if ($value['ma_loai'] == 49) {?>
                                  <li><a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value['ma_hh'] ?>"><?= $value['ten_hh'] ?></a></li>
                                <?php }?>
                              <?php } ?>
                            </ul>
                            <ul>
                              <li><a href="/du_an_mau/trang_chu/danh_muc.php?id=50">TRÀ</a></li>
                              <?php foreach ($getdata as $value) {?>
                                <?php if ($value['ma_loai'] == 50) {?>
                                  <li><a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value['ma_hh'] ?>"><?= $value['ten_hh'] ?></a></li>
                                <?php }?>
                              <?php } ?>
                            </ul>
                            <ul>
                              <li><a href="/du_an_mau/trang_chu/danh_muc.php?id=51">BÁNH MÌ</a></li>
                              <?php foreach ($getdata as $value) {?>
                                <?php if ($value['ma_loai'] == 51) {?>
                                  <li><a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value['ma_hh'] ?>"><?= $value['ten_hh'] ?></a></li>
                                <?php }?>
                              <?php } ?>
                            </ul>
                          </nav>
                        </li>
                        <li><a href="">TIN TỨC</a>
                          <nav class="menu-con">
                            <ul>
                              <li><a href="">TIN TỨC & SỰ KIỆN</a></li>
                              <li><a href="">Lịch Hoạt Động</a></li>
                              <li><a href="">Ra Mắt PhinDi</a></li>
                              <li><a href="">PhinDi Thế Hệ Mới</a></li>
                              <li><a href="">Lịch Mở Cửa</a></li>
                            </ul>
                            <ul>
                              <li><a href="">TIN KHUYẾN MẠI</a></li>
                              <li><a href="">Chương Trình Ưu Đãi</a></li>
                              <li><a href="">Nhận Thẻ Tận Hưởng</a></li>
                              <li><a href="">Combo Ưu Đãi Tháng 6</a></li>
                              <li><a href="">Đủ 3 Team Tặng 1 Ly Phin</a></li>
                            </ul>
                          </nav>
                        </li>
                        <li><a href="">TRÁCH NHIỆM CỘNG ĐỒNG</a>
                          <nav class="menu-con">
                            <ul>
                              <li><a href="">GIÁ TRỊ VĂN HÓA VIỆT</a></li>
                              <li><a href="">Đương Đại Hóa Tranh Đông Hồ</a></li>
                            </ul>
                            <ul>
                              <li><a href="">CỘNG ĐỒNG</a></li>
                              <li><a href="">Lớp Học Cho Em</a></li>
                            </ul>
                          </nav>
                        </li>
                        <li><a href="">VỀ CHÚNG TÔI</a></li>
                    </ul>
                </nav>
            </section>
        </header>
</body>
</html>