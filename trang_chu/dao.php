<?php
require_once "./../admin/db/function.php";
function select_loai_hang(){
    $sql = "SELECT * FROM loai_hang";
    $data = pdo_query($sql);
    return $data;
}
function select_hang_hoa_all($number_page,$number_product){
    $offset = ($number_page - 1) * $number_product;
    $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh ASC LIMIT $number_product OFFSET $offset";
    $data = pdo_query($sql);
    return $data;
}
function total_number_page($number_product){
    $sql = "SELECT COUNT(ma_hh) FROM hang_hoa";
    $data = pdo_query_value($sql);
    $total_number_page = ceil($data / $number_product);
    return $total_number_page;
}
function select_hang_hoa_byID($ma_loai){
    $sql = "SELECT * FROM hang_hoa WHERE ma_loai = ?";
    $data = pdo_query($sql,$ma_loai);
    return $data;
}
function select_loai_hang_byID($ma_loai){
    $sql = "SELECT * FROM loai_hang WHERE ma_loai = ?";
    $data = pdo_query($sql,$ma_loai);
    return $data;
}
function chi_tiet_hang_hoa($ma_hh){
    $sql = "SELECT * FROM hang_hoa WHERE ma_hh = ?";
    $data = pdo_query($sql,$ma_hh);
    if (empty($ma_hh) == false) {
        $sql = "UPDATE hang_hoa SET luot_xem = luot_xem + 1 WHERE ma_hh = ?";
        pdo_execute($sql,$ma_hh);
    }
    return $data;
}
function select_cmt($ma_hh){
    $sql = "SELECT khach_hang . img, khach_hang . ho_ten, binh_luan . ngay_tao, binh_luan . noi_dung FROM binh_luan INNER JOIN khach_hang ON binh_luan . ma_kh = khach_hang . ma_kh WHERE ma_hh = ? ORDER BY ma_bl DESC";
    $data = pdo_query($sql,$ma_hh);
    return $data;
}
function select_cart($ma_kh){
    $sql = "SELECT * FROM gio_hang WHERE ma_kh = ? ORDER BY ma_gio_hang DESC";
    $data = pdo_query($sql,$ma_kh);
    return $data;
}
function select_top_10(){
    $sql = "SELECT * FROM hang_hoa WHERE luot_xem > 0 ORDER BY luot_xem DESC LIMIT 0,10";
    $data = pdo_query($sql);
    return $data;
}
function search_name($keyword){
    $sql = "SELECT * FROM hang_hoa INNER JOIN loai_hang ON loai_hang . ma_loai = hang_hoa . ma_loai WHERE ten_hh LIKE '%".$keyword."%'" . " OR ten_loai LIKE '%".$keyword."%'";
    $data = pdo_query($sql);
    return $data;
}
function select_kh_byID($ma_kh){
    $sql = "SELECT * FROM khach_hang WHERE ma_kh = ?";
    $data = pdo_query_one($sql,$ma_kh);
    return $data;
}
function count_gio_hang($ma_kh){
    $sql = "SELECT COUNT(ma_gio_hang) FROM gio_hang WHERE ma_kh = ?";
    $data = pdo_query_value($sql,$ma_kh);
    return $data;
}
function select_kh_byTenTk($ten_tk)
{
    $sql = "SELECT * FROM khach_hang WHERE ten_tk = ?";
    $data = pdo_query_one($sql,$ten_tk);
    return $data;
}
extract($_REQUEST);
if (array_key_exists('login',$_REQUEST)) {
    session_start();
    $sql = "SELECT * FROM khach_hang WHERE ten_tk = ? AND mat_khau = ?";
    $nv =pdo_query_one($sql,$ten_tk,$mat_khau);
    if (empty($nv) == true) {
        $_SESSION['error'] = "Sai email hoặc mật khẩu";
        header("Location: /du_an_mau/trang_chu/login.php");
        die;
    }if (intval($nv['kich_hoat']) == 2) {
        $_SESSION['error'] = "Tài khoản của bạn đã bị khóa";
        header("Location: /du_an_mau/trang_chu/login.php");
        die;
    }
    if (isset($ghi_nho)) {
        setcookie("ten_tk",$ten_tk,time()+(86400*7));
        setcookie("mat_khau",$mat_khau,time()+(86400*7));
        header("Location: /du_an_mau/trang_chu/index.php");
        die;
    }
    if (intval($nv['vai_tro']) != 2) {
        $_SESSION['khach_hang'] = $nv;
        header("Location: /du_an_mau/trang_chu/index.php");
        die;
    }
    $_SESSION['nhan_vien'] = $nv;
    header("Location: \du_an_mau\admin\db\quan_tri.php");
}else if (array_key_exists('logout',$_REQUEST)) {
    session_start();
    if ($logout == 'dangxuat_kh') {
        if (isset($_SESSION['khach_hang'])) {
            unset($_SESSION['khach_hang']);
            header('Location:\du_an_mau\trang_chu\login.php');
        }else{
            setcookie("ten_tk","",time()-(86400*7));
            setcookie("mat_khau","",time()-(86400*7));
            header('Location:\du_an_mau\trang_chu\login.php');
        }
    }
}else if (array_key_exists('change',$_REQUEST)) {
    session_start();
    $sql = "SELECT * FROM khach_hang WHERE mat_khau = ? AND ten_tk = ? LIMIT 1";
    $count = pdo_query_one($sql,$mat_khau,$ten_tk);
    if ($count > 0){
        $sql = "UPDATE khach_hang SET mat_khau = ? WHERE ten_tk = ?";
        pdo_execute($sql,$mat_khau_moi,$ten_tk);
        $_SESSION['error_pass'] = "Đổi mật khẩu thành công";
        header("Location:/du_an_mau/trang_chu/change.php");
        die;
    } else {
        $_SESSION['error_pass'] = "Tài khoản của bạn không tồn tại";
        header("Location:/du_an_mau/trang_chu/change.php");
        die;
    }
}else if (array_key_exists('register',$_REQUEST)) {
    session_start();
    $sql = "INSERT INTO khach_hang(ten_tk, ho_ten, email, mat_khau, gioi_tinh, img, sdt) VALUES(?,?,?,?,?,?,?)";
    $sql1 = "SELECT * FROM khach_hang WHERE ten_tk = ?";
    $sql2 = "SELECT * FROM khach_hang WHERE email = ?";
    $getdata1 = pdo_query_one($sql1,$ten_tk);
    $getdata2 = pdo_query_one($sql2,$email);
    $fileUpload = $_FILES['img'];
    if (empty($getdata1) == false || empty($getdata2) == false) {
        if ($getdata1['ten_tk'] === $ten_tk) {
            $_SESSION['error_register'] = "Tài khoản của bạn đã có người đăng ký";
            header("Location:/du_an_mau/trang_chu/register.php");
            die;
        }else if ($getdata2['email'] === $email) {
        $_SESSION['error_register'] = "Email của bạn đã có người đăng ký";
        header("Location:/du_an_mau/trang_chu/register.php");
        die;
        }
    } else {
        if (strpos($fileUpload['type'], 'image') === false) {
            $_SESSION['error_register'] = "Không phải file ảnh";
            header("Location:/du_an_mau/trang_chu/register.php");
            die;
        }else if($fileUpload['size'] > 3000000) {
            $_SESSION['error_register'] = "Ảnh không được vượt quá 30MB";
            header("Location:/du_an_mau/trang_chu/register.php");
            die;
        }
        $storePath = './img/';
        $fileName = $fileUpload['name'];
        $path = $storePath . $fileName;
        move_uploaded_file($fileUpload['tmp_name'], $path);
        $img = '/du_an_mau/admin/khach_hang/img/' . $fileName;
        if( empty($gioi_tinh) == true){
            $_SESSION['error_register'] = 'Bạn chưa chọn giới tính';
            header("Location:/du_an_mau/trang_chu/register.php");
            die;
        }
        $_SESSION['error_register'] = 'ĐĂNG KÝ THÀNH CÔNG !';
        pdo_execute($sql,$ten_tk,$ho_ten,$email,$mat_khau,$gioi_tinh,$img,$sdt);
        header("Location:/du_an_mau/trang_chu/register.php");
    }
}else if (array_key_exists('cmt',$_REQUEST)) {
    session_start();
    $sql = "INSERT INTO binh_luan(noi_dung,ma_kh,ma_hh,ngay_tao) VALUES(?,?,?,?)";
    $ngay_tao = date("Y-m-d");
    if (empty($noi_dung) == true) {
        $_SESSION['error_cmt'] = 'Bạn chưa điền nội dung !';
        header("location: /du_an_mau/trang_chu/chi_tiet_hh.php?id=".$ma_hh."#binhluan");
        die;
    }
    pdo_execute($sql,$noi_dung,$ma_kh,$ma_hh,$ngay_tao);
    header("location:/du_an_mau/trang_chu/chi_tiet_hh.php?id=".$ma_hh."#binhluan");
}else if(array_key_exists('ma_hh',$_REQUEST)){
    session_start();
    if (!isset($_SESSION['khach_hang']) && !isset($_COOKIE['ten_tk']) && !isset($_COOKIE['mat_khau'])) {
       header("location:/du_an_mau/trang_chu/login.php");
       die; 
    }else {
        $sql = "SELECT * FROM gio_hang WHERE ma_hh = ?";
        $getdata = pdo_query_one($sql,$ma_hh);
        if ($getdata['ma_hh'] == $ma_hh) {
            if (isset($_SESSION['khach_hang'])) {
                $ma_kh = $_SESSION['khach_hang']['ma_kh'];
            } else {
                $ten_tk = $_COOKIE['ten_tk'];
                $khach_hang = select_kh_byTenTk($ten_tk);
                $ma_kh = $khach_hang['ma_kh'];
            }
            
            $sql = "UPDATE gio_hang SET so_luong = so_luong + 1 WHERE ma_kh = ? AND ma_hh = ?";
            pdo_execute($sql,$ma_kh,$ma_hh);
            header("location:/du_an_mau/trang_chu/danh_muc.php");
            die;
        }else {
            $sql = "SELECT * FROM hang_hoa WHERE ma_hh = ?";
            if (isset($_SESSION['khach_hang'])) {
                $ma_kh = $_SESSION['khach_hang']['ma_kh'];
            } else {
                $ten_tk = $_COOKIE['ten_tk'];
                $khach_hang = select_kh_byTenTk($ten_tk);
                $ma_kh = $khach_hang['ma_kh'];
            }
            $so_luong = 1;
            $data = pdo_query_one($sql,$ma_hh);
            $sql = "INSERT INTO gio_hang(ma_hh,ma_kh,ten_hh,img,so_luong,gia) VALUES(?,?,?,?,?,?)";
            pdo_execute($sql,$data['ma_hh'],$ma_kh,$data['ten_hh'],$data['img'],$so_luong,$data['gia']);
            header("location:/du_an_mau/trang_chu/danh_muc.php");
            die;
        }
    }
}else if(array_key_exists('delete_cart_only',$_REQUEST)) {
    $sql = "DELETE FROM gio_hang WHERE ma_hh = ?";
    pdo_execute($sql,$delete_cart_only);
    header("location:/du_an_mau/trang_chu/cart.php");
    die;
}else if(array_key_exists('delete_cart',$_REQUEST)) {
    $sql = "DELETE FROM gio_hang";
    pdo_execute($sql);
    header("location:/du_an_mau/trang_chu/cart.php");
    die;
}else if (array_key_exists('edit_profile',$_REQUEST)) {
    session_start();
    $sql = "UPDATE khach_hang SET ten_tk= ?, ho_ten = ?, email = ?, gioi_tinh = ?, img = ?, sdt = ? WHERE ma_kh = ?";
    $fileUpload = $_FILES['image'];
    if ($fileUpload['size'] > 0) {
        if (strpos($fileUpload['type'], 'image') === false) {
            $_SESSION['error_check'] = "Không phải file ảnh";
            header("Location:/du_an_mau/trang_chu/edit.php?id=".$ma_kh);
            die;
        }else if($fileUpload['size'] > 3000000) {
            $_SESSION['error_check'] = "Ảnh không được vượt quá 30MB";
            header("Location:/du_an_mau/trang_chu/edit.php?id=".$ma_kh);
            die;
        }
        $storePath = './../admin/khach_hang/img/';
        $fileName = $fileUpload['name'];
        $path = $storePath . $fileName;
        move_uploaded_file($fileUpload['tmp_name'], $path);
        $img = '/du_an_mau/admin/khach_hang/img/' . $fileName;
    }else if (empty($ho_ten) == true || empty($email) == true || empty($ten_tk) == true) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("location:/du_an_mau/trang_chu/edit.php?id=".$ma_kh);
        die;
    }
    pdo_execute($sql,$ten_tk,$ho_ten,$email,$gioi_tinh,$img,$sdt,$ma_kh);
    header("location:/du_an_mau/trang_chu/login.php");
}else if (array_key_exists('forgot',$_REQUEST)){
    session_start();
    $sql = "SELECT * FROM khach_hang WHERE ten_tk = ? AND email = ?";
    $pass = pdo_query_one($sql,$ten_tk,$email);
    if (empty($pass) == true) {
        $_SESSION['error_forgot'] = "Tài Khoản Này Của Bạn Không Tồn Tại";
        header("location:/du_an_mau/trang_chu/forgot_pass.php");
        die;
    }
    $_SESSION['error_forgot'] = "Mật Khẩu Của Bạn Là: ".$pass['mat_khau'];
    header("location:/du_an_mau/trang_chu/forgot_pass.php");
    die;
}
?>