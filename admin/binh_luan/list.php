<?php
require_once "./../db/function.php";
$sql = "SELECT hang_hoa . ma_hh, hang_hoa . ten_hh, COUNT(noi_dung) AS so_luong_cmt, MIN(binh_luan . ngay_tao) as cu_nhat, MAX(binh_luan . ngay_tao) as moi_nhat 
FROM binh_luan INNER JOIN hang_hoa ON binh_luan . ma_hh = hang_hoa . ma_hh GROUP BY hang_hoa . ma_hh, hang_hoa . ten_hh HAVING so_luong_cmt > 0";
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">DANH SÁCH BÌNH LUẬN</h1>
       <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>TÊN SẢN PHẨM</th>
                            <th>SỐ LƯỢNG BÌNH LUẬN</th>
                            <th>CŨ NHẤT</th>
                            <th>MỚI NHẤT</th>
                            <th><a href="\du_an_mau\admin\db\quan_tri.php" class="btn btn-secondary">QUAY LẠI</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $key => $value) : ?>
                            <tr>
                                <td><?php echo $value['ten_hh'] ?></td>
                                <td><?php echo $value['so_luong_cmt'] ?></td>
                                <td><?php echo $value['cu_nhat'] ?></td>
                                <td><?php echo $value['moi_nhat'] ?></td>
                                <td><a href="\du_an_mau\admin\binh_luan\chi_tiet_cmt.php?ma_hh=<?php echo $value['ma_hh']?>" class="btn btn-primary">CHI TIẾT BÌNH LUẬN</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
    </div>
</body>
</html>