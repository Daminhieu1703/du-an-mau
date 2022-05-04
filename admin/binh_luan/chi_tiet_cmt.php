<?php
require_once "./../db/function.php";
extract($_REQUEST);
if (array_key_exists('ma_hh',$_REQUEST)) {
    $sql = "SELECT binh_luan . ma_bl, khach_hang . ma_kh, khach_hang . ho_ten, binh_luan . noi_dung, ngay_tao 
    FROM binh_luan INNER JOIN khach_hang ON binh_luan . ma_kh = khach_hang . ma_kh WHERE ma_hh = ?";
    $getdata = pdo_query($sql,$ma_hh);
}else if (array_key_exists('ma_bl',$_REQUEST)) {
    $sql = "DELETE FROM binh_luan WHERE ma_bl = ?";
    pdo_execute($sql,$ma_bl);
    header("location:\du_an_mau\admin\binh_luan\list.php");
}
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">CHI TIẾT BÌNH LUẬN</h1>
       <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>MÃ KHÁCH HÀNG</th>
                            <th>TÊN KHÁCH HÀNG</th>
                            <th>NỘI DUNG BÌNH LUẬN</th>
                            <th>NGÀY BÌNH LUẬN</th>
                            <th><a href="\du_an_mau\admin\db\quan_tri.php" class="btn btn-secondary">QUAY LẠI</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $key => $value) : ?>
                            <tr>
                                <td><?php echo $value['ma_kh'] ?></td>
                                <td><?php echo $value['ho_ten'] ?></td>
                                <td><?php echo $value['noi_dung'] ?></td>
                                <td><?php echo $value['ngay_tao'] ?></td>
                                <td><a href="\du_an_mau\admin\binh_luan\chi_tiet_cmt.php?ma_bl=<?php echo $value['ma_bl'] ?>" class="btn btn-danger">XÓA</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
    </div>
</body>
</html>