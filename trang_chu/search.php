<?php require_once './dao.php';
extract($_REQUEST);
if (array_key_exists('search',$_REQUEST)) {
    $name = search_name($keyword);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="frames">
        <?php require_once "./../html_css/html/header.php";?>
        <div class="container">
            <?php if (empty($name) == false) { ?>
                <div style="display: flex;margin-top: 30px;">
                    <h4 style="color:#53382c;">Kết quả tìm kiếm cho từ khóa -></h4>
                    <h4 class="text text-danger">'<?=$keyword;?>'</h4>
                </div>
                <section class="row" style="margin: 10px 0 150px 0;">
                    <?php foreach ($name as $value) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card" style="width: 18rem;margin-bottom:40px">
                                    <img src="<?= $value["img"] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $value["ten_hh"] ?></h5>
                                        <p class="fs-3">Giá: <?= $value["gia"] ?></p>
                                        <a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value["ma_hh"] ?>" class="btn btn-outline-secondary">Xem Chi Tiết</a>
                                        <a class="btn btn-danger" href="\du_an_mau\trang_chu\dao.php?ma_hh=<?= $value["ma_hh"] ?>">Thêm Vào Giỏ</a>
                                        <p class="card-text"><i class="fas fa-eye"></i> <?= $value["luot_xem"]?> Lượt xem</p>
                                    </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </section>
            <?php }else{ ?>
                    <div class="row" style="margin: 230px 0 303px 0;">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body cart">
                                    <div class="col-sm-12 empty-cart-cls text-center"> 
                                        <img src="\du_an_mau\html_css\img\empty_search.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                                        <h3><strong>Sản Phẩm Bạn Tìm Không Tồn Tại !</strong></h3>
                                        <h4>Mời Bạn Tìm Sản Phẩm Khác</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             <?php } ?>
        </div>
        <?php require_once "./../html_css/html/footer.html";?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>