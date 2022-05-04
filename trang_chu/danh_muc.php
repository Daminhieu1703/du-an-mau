<?php require_once "./dao.php";
$number_product = (!empty($_GET['number_product'])) ? $_GET['number_product'] : 4;
$number_page = (!empty($_GET['number_page'])) ? $_GET['number_page'] : 1;
$danh_muc = select_loai_hang();
$hang_hoa_all = select_hang_hoa_all($number_page,$number_product);
if (isset( $_GET["id"])) {$ma_loai = $_GET["id"];$hang_hoa_byID = select_hang_hoa_byID($ma_loai);$loai_hang_byID = select_loai_hang_byID($ma_loai);}
$select_top_10 =  select_top_10();
$total_number_page = total_number_page($number_product);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực Đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="frames">
        <?php
        require_once "./../html_css/html/header.php";
        ?>
        <br>
        <div class="content" style="display: flex;">
            <div class="danhmuc" style="margin-left: 35px">
                <nav>
                    <div class="card" style="width: 18rem;">
                        <a href="\du_an_mau\trang_chu\danh_muc.php" class="btn btn-danger">Danh Mục</a>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($danh_muc as $value) { ?>
                                <a href="danh_muc.php?id=<?= $value['ma_loai']?>" class="list-group-item list-group-item-action"><?=$value['ten_loai']?></a>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
                <br>
                <div class="card" style="width: 18rem;margin-bottom: 20px;">
                <a class="btn btn-danger" href="\du_an_mau\trang_chu\danh_muc.php?top_10_luot_xem">Top 10 Sản Phẩm Nhiều Lượt Xem</a>
                <ul class="list-group list-group-flush">
                    <?php foreach ($select_top_10 as $value) { ?>
                        <a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?=$value['ma_hh']?>" class="list-group-item list-group-item-action"><img src="<?=$value['img']?>" alt="" width="30" height="30"> <?= $value['ten_hh']?></a>
                    <?php } ?>
                </ul>
                </div>
            </div>
           <div class="container">
            <?php if (empty($ma_loai) == false) { ?>
                <?php foreach ($loai_hang_byID as $value) { ?>
                    <div class="text"style="color:#53382c;width: 810px;margin-bottom:61px">
                        <h1 style="font-size: 70px;"><?=$value['ten_loai'];?></h1>
                        <p><?=$value['mo_ta'];?></p>
                    </div>
                <?php } ?>
                    <section class="row">
                    <?php foreach ($hang_hoa_byID as $value) : ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card" style="width: 18rem;" id="sanpham">
                                        <img src="<?= $value["img"] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $value["ten_hh"] ?></h5>
                                            <p class="fs-5">Giá: <?= number_format($value['gia'],0,',','.') ?>VNĐ</p>
                                            <a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value["ma_hh"] ?>" class="btn btn-outline-secondary">Xem Chi Tiết</a>
                                            <a class="btn btn-danger" href="\du_an_mau\trang_chu\dao.php?ma_hh=<?= $value["ma_hh"] ?>">Thêm Vào Giỏ</a>
                                            <p class="card-text"><i class="fas fa-eye"></i> <?= $value["luot_xem"]?> Lượt xem</p>
                                        </div>
                                    </div>
                                </div>
                    <?php endforeach; ?>
                    </section>
                <?php  }else{ ?>
                    <?php
                        extract($_REQUEST);
                        if(array_key_exists('top_10_luot_xem',$_REQUEST)){ ?>
                        <h1 style="font-size:70px;color:#53382c;width: 810px;margin-bottom:20px">TOP 10 SẢN PHẨM</h1>
                        <section class="row">
                        <?php foreach ($select_top_10 as $value) : ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card" style="width: 18rem;" id="sanpham">
                                        <img src="<?= $value["img"] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $value["ten_hh"] ?></h5>
                                            <p class="fs-5">Giá: <?= number_format($value['gia'],0,',','.') ?>VNĐ</p>
                                            <a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value["ma_hh"] ?>" class="btn btn-outline-secondary">Xem Chi Tiết</a>
                                            <a class="btn btn-danger" href="\du_an_mau\trang_chu\dao.php?ma_hh=<?= $value["ma_hh"] ?>">Thêm Vào Giỏ</a>
                                            <p class="card-text"><i class="fas fa-eye"></i> <?= $value["luot_xem"]?> Lượt xem</p>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                        </section>
                    <?php }else{ ?>
                        <h1 style="font-size:70px;color:#53382c;width: 810px;margin-bottom:20px">DANH MỤC</h1>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php for ($i=1; $i <= $total_number_page ; $i++) {  ?>
                                    <li class="page-item"><a class="page-link" href="danh_muc.php?number_product=<?=$total_number_page?>&number_page=<?= $i ?>"><?= $i ?></a></li>
                                <?php } ?>
                            </ul>
                        </nav>
                        <section class="row">
                        <?php foreach ($hang_hoa_all as $value) : ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?= $value["img"] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $value["ten_hh"] ?></h5>
                                            <p class="fs-5">Giá: <?= number_format($value['gia'],0,',','.') ?>VNĐ</p>
                                            <a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value["ma_hh"] ?>" class="btn btn-outline-secondary">Xem Chi Tiết</a>
                                            <a class="btn btn-danger" href="\du_an_mau\trang_chu\dao.php?ma_hh=<?= $value["ma_hh"] ?>">Thêm Vào Giỏ</a>
                                            <p class="card-text"><i class="fas fa-eye"></i> <?= $value["luot_xem"]?> Lượt xem</p>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                        </section>
                    <?php } ?>
                <?php } ?>
           </div>
        </div>
        <?php
        require_once "./../html_css/html/footer.html";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>