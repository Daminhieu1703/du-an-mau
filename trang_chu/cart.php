<?php require_once "./handle.php"; $price_cart = 0;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="\du_an_mau\html_css\css\cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="frames">
        <?php
        require_once "./../html_css/html/header.php";
        ?>
        <div class="container">
        <?php if (isset($_SESSION['khach_hang']) || isset($_COOKIE['ten_tk']) && isset($_COOKIE['mat_khau'])) { ?>
                <?php if (isset( $_SESSION['khach_hang']['ma_kh'])) {
                    $ma_kh = $_SESSION['khach_hang']['ma_kh'];
                    $select_cart = select_cart($ma_kh);
                    $profile = select_kh_byID($ma_kh); 
                    $count= count_gio_hang($ma_kh);
                }else {
                    $ten_tk = $_COOKIE['ten_tk'];
                    $khach_hang = select_kh_byTenTk($ten_tk);
                    $ma_kh = $khach_hang['ma_kh'];
                    $select_cart = select_cart($ma_kh);
                    $profile = select_kh_byID($ma_kh); 
                    $count= count_gio_hang($ma_kh);
                }
                ?>
                <?php if (empty($select_cart) == false) { ?>
                    <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-md-9">
                        <div class="ibox">
                            <div class="ibox-content">
                                <a href="\du_an_mau\trang_chu\danh_muc.php"  class="btn btn-white"><i class="fa fa-arrow-left"></i>Quay Về Danh Mục</a>
                            </div>
                            <div class="ibox-title">
                                <span class="pull-right">Tổng: (<strong><?=$count?></strong>) Sản Phẩm Trong Giỏ Hàng</span>
                            </div>
                            <?php foreach ($select_cart as $value) { ?>
                                <div class="ibox-content">
                                    <div class="table-responsive">  
                                        <table class="table shoping-cart-table">
                                            <tbody>
                                            <tr>
                                                <td width="90"><img src="<?= $value['img'] ?>" alt=""></td>
                                                <td class="desc">
                                                    <h3><a href="\du_an_mau\trang_chu\chi_tiet_hh.php?id=<?= $value['ma_hh'] ?>" class="text-danger"><?= $value['ten_hh'] ?></a></h3>
                                                    <div class="m-t-sm">
                                                        <a href="\du_an_mau\trang_chu\dao.php?delete_cart_only=<?= $value['ma_hh'] ?>" class="text-muted"><i class="fa fa-trash"></i> Xóa Sản Phẩm Khỏi Giỏ Hàng</a>
                                                    </div>
                                                </td>
                                                <td width="65"><input type="number" class="form-control" value="<?= $value['so_luong'] ?>"></td>
                                                <td><h4><?= number_format($value['gia'],0,',','.') ?>VNĐ</h4></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               <?php $price_cart += $value['gia'] ?>
                            <?php }?>
                            <div class="ibox-content">
                                <a class="btn btn-danger" href="\du_an_mau\trang_chu\dao.php?delete_cart"><i class="fa fa-trash"></i> Xóa Hết</a>
                            </div>  
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <form action="" method="post">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5 class="font-bold">Tổng Số Tiền Của Giỏ Hàng</h5>
                                </div>
                                <div class="ibox-content">
                                    <span>Total</span>
                                    <h2 class="font-bold"><?= number_format($price_cart,0,',','.') ?>VNĐ</h2>
                                    <input type="hidden" value="<?= $price_cart?>" name="tong_tien">
                                    <hr>
                                    <div class="m-t-sm">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-danger btn-sm" name="checkout"><i class="fa fa-shopping-cart"></i>Đặt Hàng</button>
                                            <a href="#" class="btn btn-white btn-sm">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5 class="font-bold">Thông Tin Người Nhận Hàng</h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <h6 class="product-name">Họ Và Tên</h6>
                                        <div class="m-t text-righ">
                                            <input type="hidden" value="<?= $profile['ma_kh']?>" name="ma_kh">
                                        <input type="text" class="form-control" placeholder="Username" value="<?= $profile['ho_ten']?>" name="ho_ten" disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 href="#" class="product-name">Email</h6>
                                        <div class="m-t text-righ">
                                        <input type="text" class="form-control" placeholder="Email" value="<?= $profile['email']?>"  name="email" disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 href="#" class="product-name">Số Điện Thoại</h6>
                                        <div class="m-t text-righ">
                                        <input type="text" class="form-control" placeholder="Số Điện Thoại" name="sdt" value="<?= $profile['sdt']?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 href="#" class="product-name">Địa Chỉ</h6>
                                        <div class="m-t text-righ">
                                        <input type="text" class="form-control" placeholder="Địa Chỉ" name="dia_chi">
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 href="#" class="product-name">Ghi Chú</h6>
                                        <div class="m-t text-righ">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="ghi_chu"></textarea>
                                            <label for="floatingTextarea">Comments</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="ibox">
                            <div class="ibox-title"><h5 class="font-bold">Hỗ Trợ</h5></div>
                            <div class="ibox-content text-center">
                                <h3><i class="fa fa-phone"></i> 034.277.0723</h3>
                                <span class="small">
                                    Vui lòng liên hệ với chúng tôi nếu bạn có bất kỳ câu hỏi nào. Chúng tôi sẵn sàng 24h.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php }else{ ?>
                    <div class="container" style="margin: 200px 0 218px 0;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body cart">
                                        <div class="col-sm-12 empty-cart-cls text-center"> <img src="\du_an_mau\html_css\img\cart_empty.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                                            <h3><strong>Giỏ Hàng Của Bạn Đang Trống</strong></h3>
                                            <h4>Quay Lại Danh Mục Và Thêm Sản Phẩm Vào Giỏ Hàng Nhé</h4> <a href="\du_an_mau\trang_chu\danh_muc.php" class="btn btn-danger cart-btn-transform m-3" data-abc="true">Quay Về Danh Mục</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        <?php }else{ ?>
            <div class="container" style="margin: 190px 0 236px 0;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body cart">
                                <div class="col-sm-12 empty-cart-cls text-center"> 
                                    <img src="\du_an_mau\html_css\img\empty-cart-2.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                                    <h3><strong>Giỏ Hàng Của Bạn Đang Trống Vì Bạn Chưa Đăng Nhập</strong></h3>
                                    <h4>Mời Bạn Đăng Nhập Để Xem Được Giỏ Hàng Của Mình</h4> <a href="\du_an_mau\trang_chu\login.php" class="btn btn-danger cart-btn-transform m-3" data-abc="true">Đăng Nhập</a>
                                </div>
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