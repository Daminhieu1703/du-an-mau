<?php require_once "./dao.php";
$ma_hh = $_GET['id'];
$data = chi_tiet_hang_hoa($ma_hh);
$cmt = select_cmt($ma_hh);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="frames">
        <?php require_once "./../html_css/html/header.php";?>
        <?php foreach ($data as $value) { ?>
            <div class="container py-4 my-4 mx-auto d-flex flex-column">
                <div class="container-body mt-4">
                    <div class="row r3">
                        <h1 style="font-size: 70px;color:#53382c;"><?= $value['ten_hh']?></h1>
                        <div class="col-md-7"><img src="<?= $value['img']?>" width="600px" height="600px"></div>
                        <div class="col-md-5 p-0 klo">
                            <p class="fs-5"><?= $value['mo_ta']?></p>
                            <p class="fs-5">loại Hàng: <?= ($value['dac_biet'] == 1)? "Hàng Đặc Biệt":"Hàng Thường"?></p>
                            <p class="fs-5">Trạng Thái: <?= ($value['trang_thai'] == 1)? "Còn Hàng":"Hết Hàng"?></p>
                            <p class="fs-5">Số Lượng: <?= $value['so_luong']?></p>
                            <p class="fs-5">Ngày Bán: <?= $value['ngay_tao']?></p>
                            <a class="btn btn-outline-danger" href="\du_an_mau\trang_chu\dao.php?ma_hh=<?= $value['ma_hh']?>">THÊM VÀO GIỎ HÀNG</a>
                            <br><br>
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
                                <form action="\du_an_mau\trang_chu\dao.php" method="post">
                                    <input type="hidden" value="<?= $profile['ma_kh']?>" name="ma_kh">
                                    <input type="hidden" value="<?= $value['ma_hh']?>" name="ma_hh">
                                    <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                        <img class="img-fluid img-responsive rounded-circle mr-2" src="<?=  $profile['img']?>" width="38">
                                        <input type="text" class="form-control mr-3" placeholder="Add comment" style="margin: 0 10px 0 10px;" name="noi_dung">
                                        <button type="submit" class="btn btn-danger" name="cmt">Gửi</button>
                                    </div>
                                    <div class="d-grid gap-2 fw-bold text-danger text-center">
                                        <?php if (isset($_SESSION['error_cmt'])) {echo $_SESSION['error_cmt']; unset($_SESSION['error_cmt']);}?>
                                    </div>
                                </form>
                            <?php }else{ ?>
                                <div class="d-grid gap-2 fw-bold text-danger text-center">
                                    <p>BẠN PHẢI ĐĂNG NHẬP MỚI CÓ THỂ BÌNH LUẬN ĐƯỢC</p>
                                </div>
                            <?php } ?>
                                <?php foreach ($cmt as $value) { ?>
                                    <?php if (empty($value['noi_dung']) == false) { ?>
                                    <div class="bg-white p-2">
                                        <div class="d-flex flex-row user-info">
                                            <img class="rounded-circle" src="<?= $value['img']?>" width="35" height="35" alt="Rỗng" style="margin:7px 10px 0 0;">
                                            <div class="d-flex flex-column justify-content-start ml-2">
                                                <span class="d-block font-weight-bold name"><?= $value['ho_ten']?></span>
                                                <span class="date text-black-50"><?= $value['ngay_tao']?></span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <p id="binhluan" class="comment-text"><?= $value['noi_dung']?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php require_once "./../html_css/html/footer.html";?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>