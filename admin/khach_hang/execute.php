<?php
require_once "./../db/function.php";
session_start();
extract($_REQUEST);
if (array_key_exists('them',$_REQUEST)) {
    $sql = "INSERT INTO khach_hang(ten_tk, ho_ten, email, mat_khau, gioi_tinh, kich_hoat, vai_tro, img, sdt) VALUES(?,?,?,?,?,?,?,?,?)";
    $fileUpload = $_FILES['img'];
    if (strpos($fileUpload['type'], 'image') === false) {
        $_SESSION['error_check'] = "Không phải file ảnh";
        header("Location:/du_an_mau/admin/khach_hang/new.php");
        die;
    }else if($fileUpload['size'] > 3000000) {
        $_SESSION['error_check'] = "Ảnh không được vượt quá 30MB";
        header("location: /du_an_mau/admin/khach_hang/new.php");
        die;
    }
    $storePath = './img/';
    $fileName = $fileUpload['name'];
    $path = $storePath . $fileName;
    move_uploaded_file($fileUpload['tmp_name'], $path);
    $img = '/du_an_mau/admin/khach_hang/img/' . $fileName;
    if (empty($ten_tk) == true || empty($ho_ten) == true || empty($email) == true || empty($mat_khau) == true || empty($gioi_tinh) == true || empty($kich_hoat) == true || empty($vai_tro) == true || empty($sdt) == true) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("location: /du_an_mau/admin/khach_hang/new.php");
        die;
    }
    pdo_execute($sql,$ten_tk,$ho_ten,$email,$mat_khau,$gioi_tinh,$kich_hoat,$vai_tro,$img,$sdt);
    header("Location:\du_an_mau\admin\khach_hang\list.php");
}else if (array_key_exists('sua',$_REQUEST)) {
    $sql = "UPDATE khach_hang SET ten_tk = ?, ho_ten = ?, email = ?, mat_khau = ?, gioi_tinh = ?, kich_hoat = ?, vai_tro = ?, img = ?, sdt = ? WHERE ma_kh = ?";
    $fileUpload = $_FILES['image'];
    if ($fileUpload['size'] > 0) {
        if (strpos($fileUpload['type'], 'image') === false) {
            $_SESSION['error_check'] = "Không phải file ảnh";
            header("Location:/du_an_mau/admin/khach_hang/edit.php?id=".$ma_kh);
            die;
        }else if($fileUpload['size'] > 3000000) {
            $_SESSION['error_check'] = "Ảnh không được vượt quá 30MB";
            header("Location:/du_an_mau/admin/khach_hang/edit.php?id=".$ma_kh);
            die;
        }
        $storePath = './img/';
        $fileName = $fileUpload['name'];
        $path = $storePath . $fileName;
        move_uploaded_file($fileUpload['tmp_name'], $path);
        $img = '/du_an_mau/admin/khach_hang/img/' . $fileName;
    }
    if (empty($ten_tk) == true || empty($ho_ten) == true || empty($email) == true || empty($mat_khau) == true || empty($gioi_tinh) == true || empty($kich_hoat) == true || empty($vai_tro) == true || empty($sdt) == true) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("Location:/du_an_mau/admin/khach_hang/edit.php?id=".$ma_kh);
        die;
    }
    pdo_execute($sql,$ten_tk,$ho_ten,$email,$mat_khau,$gioi_tinh,$kich_hoat,$vai_tro,$img,$sdt,$ma_kh);
    header("location: \du_an_mau\admin\khach_hang\list.php");
}else if (isset($_GET["id"])){
    $ma_kh = $_GET["id"];
    $sql1 = "DELETE FROM gio_hang WHERE ma_kh = $ma_kh";
    $sql2 = "DELETE FROM binh_luan WHERE ma_kh = $ma_kh";
    $sql3 = "DELETE FROM khach_hang WHERE ma_kh = $ma_kh";
    pdo_execute($sql1);
    pdo_execute($sql2);
    pdo_execute($sql3);
    header("location:\du_an_mau\admin\khach_hang\list.php");
}
?>