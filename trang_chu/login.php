<?php require_once './dao.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="\du_an_mau\html_css\css\profile.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="frames">
        <?php require_once "./../html_css/html/header.php";?>
        <?php if (isset($_SESSION['khach_hang']) || isset($_COOKIE['ten_tk']) && isset($_COOKIE['mat_khau'])) { ?>
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
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="row container d-flex justify-content-center">
                        <div class="col-xl-6 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25"> <img src="<?= $profile['img']?>" class="img-radius" alt="User-Profile-Image"> </div>
                                            <h4 class="f-w-600"><?= $profile['ten_tk']?></h4>
                                            <p>Mã Số: <?= $profile['ma_kh']?></p> <a href="\du_an_mau\trang_chu\edit.php?id=<?= $profile['ma_kh']?>" class="edit"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-block">
                                            <h3 class="m-b-20 p-b-5 b-b-default f-w-600">Thông Tin Cá Nhân</h3>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4 class="m-b-10 f-w-600">Họ Và Tên</h4>
                                                    <p class="text-muted f-w-400"><?= $profile['ho_ten']?></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="m-b-10 f-w-600">Số Điện Thoại</h4>
                                                    <p class="text-muted f-w-400"><?= $profile['sdt']?></p>
                                                </div>
                                            </div>
                                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4 class="m-b-10 f-w-600">Email</h4>
                                                    <p class="text-muted f-w-400"><?= $profile['email']?></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="m-b-10 f-w-600">Giới Tính</h4>
                                                    <p class="text-muted f-w-400"><?= ($profile['gioi_tinh'] == 1)? "Nam":"Nữ"?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else{ ?>
            <form action="\du_an_mau\trang_chu\dao.php" method="post" style="width: 500px;margin: 0 0 431px 700px;">
                <br>
                <h1 style="text-align:center;color: #b22830;">ĐĂNG NHẬP</h1>
                <div class="input-group flex-nowrap">
                    <span class="btn btn-danger" id="addon-wrapping">Tài Khoản</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" name="ten_tk">
                </div>
                <br>
                <div class="input-group flex-nowrap">
                    <span class="btn btn-danger" id="addon-wrapping">Mật Khẩu</span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="addon-wrapping" name="mat_khau">
                </div>
                <br>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="ghi_nho">Ghi nhớ tài khoản ?
                </label>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-danger" name="login">Đăng Nhập</button>
                <a href="\du_an_mau\trang_chu\index.php" class="btn btn-outline-secondary">Hủy</a>
                <a href="\du_an_mau\trang_chu\register.php" class="btn btn-link">Đăng ký</a>
                <a href="\du_an_mau\trang_chu\change.php" class="btn btn-link">Đổi Mật Khẩu</a>
                <a href="\du_an_mau\trang_chu\forgot_pass.php" class="btn btn-link">Quên Mật Khẩu</a>
                <div class="d-grid gap-2 fw-bold text-danger text-center">
                        <?php if (isset($_SESSION['error'])) {echo $_SESSION['error']; unset($_SESSION['error']);}?>
                </div>
            </form>
        <?php } ?>
        <?php
        require_once "./../html_css/html/footer.html";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>