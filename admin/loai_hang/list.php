<?php
require_once "./../db/function.php";
$sql = "SELECT * FROM loai_hang ORDER BY ma_loai DESC";
$getdata = pdo_query($sql);
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
       <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>MÃ LOẠI</th>
                            <th>TÊN LOẠI</th>
                            <th>MÔ TẢ</th>
                            <th><a href="\du_an_mau\admin\loai_hang\new.php" class="btn btn-success">THÊM</a></th>
                            <th><a href="\du_an_mau\admin\db\quan_tri.php" class="btn btn-secondary">QUAY LẠI</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $key => $value) : ?>
                            <tr>
                                <td><?php echo $value['ma_loai'] ?></td>
                                <td><?php echo $value['ten_loai'] ?></td>
                                <td><?php echo $value['mo_ta'] ?></td>
                                <td><a href="\du_an_mau\admin\loai_hang\edit.php?id=<?php echo $value['ma_loai'] ?>" class="btn btn-primary">SỬA</a></td>
                                <td><a href="\du_an_mau\admin\loai_hang\execute.php?id=<?php echo $value['ma_loai'] ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa chứ ?')">XÓA</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
    </div>
</body>
</html>