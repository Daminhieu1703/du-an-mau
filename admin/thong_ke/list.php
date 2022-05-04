<?php
require_once "./../db/function.php";
$sql = "SELECT loai_hang. ma_loai, loai_hang . ten_loai, COUNT(hang_hoa . so_luong) AS sl, MAX(gia) AS gia_cao, MIN(gia) AS gia_thap, AVG(gia) AS gia_tb 
FROM hang_hoa INNER JOIN loai_hang ON loai_hang . ma_loai = hang_hoa . ma_loai GROUP BY loai_hang. ma_loai, loai_hang . ten_loai";
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">DÁNH SÁCH THỐNG KÊ</h1>
        <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>TÊN LOẠI</th>
                            <th>SỐ LƯỢNG</th>
                            <th>GIÁ CAO</th>
                            <th>GIÁ THẤP</th>
                            <th>GIÁ TRUNG BÌNH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $key => $value) : ?>
                            <tr>
                                <td><?php echo $value['ten_loai'] ?></td>
                                <td><?php echo $value['sl'] ?></td>
                                <td><?php echo number_format($value['gia_cao'],0,',','.') ?></td>
                                <td><?php echo number_format($value['gia_thap'],0,',','.') ?></td>
                                <td><?php echo number_format($value['gia_tb'],0,',','.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                            <th><a href="\du_an_mau\admin\thong_ke\thong_ke.php" class="btn btn-success">XEM BIỂU ĐỒ</a></th>
                            <th><a href="\du_an_mau\admin\db\quan_tri.php" class="btn btn-secondary">QUAY LẠI</a></th>
                    </tbody>
        </table>
        </div>
</body>
</html>