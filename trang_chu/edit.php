<?php require_once './dao.php';
$ma_kh = $_GET['id'];
$profile = select_kh_byID($ma_kh);
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
    <div class="frames">
        <?php
        require_once "./../html_css/html/header.php";
        ?>
        <div class="container" style="margin: 50px 0 143px 300px;">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-md-8">
                   <form action="\du_an_mau\trang_chu\dao.php" method="post" enctype="multipart/form-data">
                        <div class="card py-5">
                            <div class="mt-3 px-4 d-flex justify-content-between align-items-center"><h5 class="m-b-10 f-w-600">Sửa Thông Tin Cá Nhân</h5></div>
                            <div class="row mt-3 g-2">
                                <div class="col-md-6">
                                    <div class="inputs px-4"> 
                                        <span class="text-uppercase">Tài Khoản</span> 
                                        <input type="hidden" name="ma_kh" value="<?= $profile['ma_kh']?>">
                                        <input type="text" class="form-control" value="<?= $profile['ten_tk']?>" name="ten_tk"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputs px-4"> 
                                        <span class="text-uppercase">Họ Và Tên</span> 
                                        <input type="text" class="form-control" value="<?= $profile['ho_ten']?>" name="ho_ten"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 g-2">
                                <div class="col-md-6">
                                    <div class="inputs px-4"> 
                                        <span class="text-uppercase">Email</span> 
                                        <input type="text" class="form-control" value="<?= $profile['email']?>" name="email"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputs px-4"> 
                                        <span class="text-uppercase">Số Điện Thoại</span> 
                                        <input type="text" class="form-control" value="<?= $profile['sdt']?>" name="sdt"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 g-2">
                                <div class="col-md-6">
                                <div class="inputs px-4">
                                    <span class="text-uppercase name">Ảnh</span>
                                    <div class="d-flex flex-row align-items-center mt-2"> 
                                        <img src="<?= $profile['img']?>" width="60" height="60" class="rounded">
                                        <input type="hidden" name="img" value="<?= $profile['img']?>">
                                    </div>
                                </div>
                                </div>   
                                <div class="col-md-6">     
                                    <div class="inputs px-4">
                                        <span class="text-uppercase">Đổi Ảnh</span>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>   
                            </div>
                            <div class="row g-2 mt-3"> 
                                <span class="text-uppercase px-4 name">Giới Tính</span>
                                <div class="col-md-6">
                                    <div class="px-4"> 
                                        <label class="radio"> 
                                            <input type="radio" class="form-check-input" name="gioi_tinh" value="1" <?= ($profile["gioi_tinh"] == 1) ? "checked" : "" ?>> 
                                            <span>Nam</span> 
                                        </label> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="px-4"> 
                                        <label class="radio"> 
                                            <input type="radio" class="form-check-input" name="gioi_tinh" value="2" <?= ($profile["gioi_tinh"] == 2) ? "checked" : "" ?>> 
                                            <span>Nữ</span> 
                                        </label> 
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 px-4 d-flex justify-content-between align-items-center"><button class="btn btn-danger" name="edit_profile" type="submit">SỬA</button> <a href="\du_an_mau\trang_chu\login.php" class="btn btn-outline-danger">HỦY</a></div>
                            <div class="d-grid gap-2 fw-bold text-danger text-center">
                            <?php if (isset($_SESSION['error_check'])) {echo $_SESSION['error_check']; unset($_SESSION['error_check']);}?>
                        </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
        <?php
        require_once "./../html_css/html/footer.html";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>