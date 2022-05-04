<?php
require_once "./../db/function.php";
session_start();
$ma_loai =  $_GET['id'];
$sql = "SELECT * FROM loai_hang WHERE ma_loai = ?";
$data = pdo_query_one($sql,$ma_loai);
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
        <form class="col-8 offset-2" method="POST" action="\du_an_mau\admin\loai_hang\execute.php" enctype="multipart/form-data">
                <input type="hidden" name="ma_loai" value="<?php echo $ma_loai ?>">
                <div class="mt-3">
                    <label>TÊN LOẠI</label>
                    <input class="form-control" type="text" name="ma_loai" value="<?php echo $ma_loai ?>" disabled>
                </div>
                <div class="mt-3">
                    <label>TÊN LOẠI</label>
                    <input class="form-control" type="text" name="ten_loai" value="<?php echo $data['ten_loai'] ?>">
                </div>
                <div class="mt-3">
                    <label>MÔ TẢ</label>
                    <div style="display:flex;">
                        <input class="form-control" type="text" name="mo_ta" value="<?php echo $data['mo_ta'] ?>">
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 fw-bold text-danger text-center">
                <?php if (isset($_SESSION['error_check'])) {echo $_SESSION['error_check']; unset($_SESSION['error_check']);}?>
                    <button type="submit" class="btn btn-primary" name="sua">SỬA</button>
                    <a href="\du_an_mau\admin\loai_hang\list.php" class="btn btn-danger">HỦY</a>
                </div>
            </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>