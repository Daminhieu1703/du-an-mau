<?php
require_once "./../db/function.php";
session_start();
$sql = "SELECT * FROM loai_hang";
$data = pdo_query($sql);
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">THÊM MỚI HÀNG HÓA</h1>
        <form class="col-8 offset-2" method="POST" action="\du_an_mau\admin\hang_hoa\execute.php" enctype="multipart/form-data">
                <div class="mt-3">
                    <label>TÊN HÀNG HÓA</label>
                    <input class="form-control" type="text" name="ten_hh">
                </div>
                <div class="mt-3">
                    <label>GIÁ</label>
                    <input class="form-control" type="number" name="gia">
                </div>
                <div class="mt-3">
                    <label>MÔ TẢ</label>
                    <input class="form-control" type="text" name="mo_ta">
                </div>
                <div class="mt-3">
                    <label>GIẢM GIÁ</label>
                    <input class="form-control" type="number" name="giam_gia">
                </div>
                <div class="mt-3">
                    <label>TRẠNG THÁI</label>
                    <select name="trang_thai" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn trạng thái</option>
                        <option value="1">Còn Hàng</option>
                        <option value="2">Hết Hàng</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>SỐ LƯỢNG</label>
                    <input class="form-control" type="number" name="so_luong">
                </div>
                <div class="mt-3">
                    <label>LOẠI HÀNG</label>
                    <select name="ma_loai" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn loại hàng</option>
                        <?php foreach ($data as $key => $getdata) : ?>
                            <option value="<?=$getdata['ma_loai']?>"><?=$getdata['ten_loai']?></option>
                        <?php endforeach; ?> 
                    </select>
                </div>
                <div class="mt-3">
                    <label>ĐẶC BIỆT</label>
                    <select name="dac_biet" id="" class="form-control">
                        <option value="" selected disabled>Mời bạn chọn đặc biệt</option>
                        <option value="1">Hàng Đặc Biệt</option>
                        <option value="2">Hàng Thường</option>
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
                    <a href="\du_an_mau\admin\hang_hoa\list.php" class="btn btn-danger">HỦY</a>
                </div>
            </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>