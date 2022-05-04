<?php
require_once "./../db/function.php";
$number_product = (!empty($_GET['number_product'])) ? $_GET['number_product'] : 4;
$number_page = (!empty($_GET['number_page'])) ? $_GET['number_page'] : 1;
$offset = ($number_page - 1) * $number_product;
$sql = "SELECT * FROM hang_hoa ORDER BY ma_hh DESC LIMIT $number_product OFFSET $offset";
$getdata = pdo_query($sql);
$sql2 = "SELECT COUNT(ma_hh) FROM hang_hoa";
$getdata2 = pdo_query_value($sql2);
$total_number_page = ceil($getdata2 / $number_product);
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
        <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">DANH SÁCH HÀNG HÓA</h1>
       <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>MÃ HÀNG HÓA</th>
                            <th>TÊN HÀNG HÓA</th>
                            <th>GIÁ</th>
                            <th>GIẢM GIÁ</th>
                            <th>MÔ TẢ</th>
                            <th>NGÀY TẠO</th>
                            <th>LƯỢT XEM</th>
                            <th>TRẠNG THÁI</th>
                            <th>SỐ LƯỢNG</th>
                            <th>MÃ LOẠI</th>
                            <th>ĐẶC BIỆT</th>
                            <th>ẢNH</th>
                            <th><a href="\du_an_mau\admin\hang_hoa\new.php" class="btn btn-success">THÊM</a></th>
                            <th><a href="\du_an_mau\admin\db\quan_tri.php" class="btn btn-secondary">QUAY LẠI</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $key => $value) : ?>
                            <tr>
                                <td><?php echo $value['ma_hh'] ?></td>
                                <td><?php echo $value['ten_hh'] ?></td>
                                <td><?php echo $value['gia'] ?></td>
                                <td><?php echo $value['giam_gia'] ?></td>
                                <td><?php echo $value['mo_ta'] ?></td>
                                <td><?php echo $value['ngay_tao'] ?></td>
                                <td><?php echo $value['luot_xem'] ?></td>
                                <td><?php echo ($value['trang_thai'] == 1) ? "Còn Hàng" : "Hết Hàng" ?></td>
                                <td><?php echo $value['so_luong'] ?></td>
                                <td><?php echo $value['ma_loai'] ?></td>
                                <td><?php echo ($value['dac_biet'] == 1)? "Hàng đặc biệt" : "hàng thường" ?></td>
                                <td><img src="<?php echo $value['img'] ?>" style="width:50px; height:50px" alt=""></td>
                                <td><a href="\du_an_mau\admin\hang_hoa\edit.php?id=<?php echo $value['ma_hh'] ?>" class="btn btn-primary">SỬA</a></td>
                                <td><a href="\du_an_mau\admin\hang_hoa\execute.php?id=<?php echo $value['ma_hh'] ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa chứ ?')">XÓA</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i=1; $i <= $total_number_page ; $i++) {  ?>
                        <li class="page-item"><a class="page-link" href="list.php?number_product=<?=$total_number_page?>&number_page=<?= $i ?>"><?= $i ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>