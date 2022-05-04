<?php
require_once "./../db/function.php";
session_start();
extract($_REQUEST);
if (array_key_exists('them',$_REQUEST)) {
    $sql = "INSERT INTO hang_hoa(ten_hh, gia, mo_ta, giam_gia, img, ngay_tao, trang_thai, so_luong, ma_loai, dac_biet) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $fileUpload = $_FILES['img'];
    $ngay_tao = date("Y-m-d");
    if (strpos($fileUpload['type'], 'image') === false) {
        $_SESSION['error_check'] = "Không phải file ảnh";
        header("Location:/du_an_mau/admin/hang_hoa/new.php");
        die;
    }else if($fileUpload['size'] > 3000000) {
        $_SESSION['error_check'] = "Ảnh không được vượt quá 30MB";
        header("location: /du_an_mau/admin/hang_hoa/new.php");
        die;
    }
    $storePath = './img/';
    $fileName = $fileUpload['name'];
    $path = $storePath . $fileName;
    move_uploaded_file($fileUpload['tmp_name'], $path);
    $img = '/du_an_mau/admin/hang_hoa/img/' . $fileName;
    if (empty($ten_hh) == true || empty($gia) == true || empty($mo_ta) == true || empty($trang_thai) == true || empty($so_luong) == true || empty($ma_loai) == true || empty($dac_biet) == true) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("location: /du_an_mau/admin/hang_hoa/new.php");
        die;
    }
    pdo_execute($sql,$ten_hh,$gia,$mo_ta,$giam_gia,$img,$ngay_tao,$trang_thai,$so_luong,$ma_loai,$dac_biet);
    header("Location:\du_an_mau\admin\hang_hoa\list.php");
}else if (array_key_exists('sua',$_REQUEST)) {
    $sql = "UPDATE hang_hoa SET ten_hh = ?, gia = ?, mo_ta = ?, giam_gia = ?, img = ?, ngay_tao = ?, trang_thai = ?, so_luong = ?, ma_loai = ?, dac_biet = ? WHERE ma_hh = ?";
    $fileUpload = $_FILES['image'];
    $ngay_tao = date("Y-m-d");
    if ($fileUpload['size'] > 0) {
        if (strpos($fileUpload['type'], 'image') === false) {
            $_SESSION['error_check'] = "Không phải file ảnh";
            header("Location:/du_an_mau/admin/hang_hoa/edit.php?id=".$ma_hh);
            die;
        }else if($fileUpload['size'] > 3000000) {
            $_SESSION['error_check'] = "Ảnh không được vượt quá 30MB";
            header("Location:/du_an_mau/admin/hang_hoa/edit.php?id=".$ma_hh);
            die;
        }
        $storePath = './img/';
        $fileName = $fileUpload['name'];
        $path = $storePath . $fileName;
        move_uploaded_file($fileUpload['tmp_name'], $path);
        $img = '/du_an_mau/admin/hang_hoa/img/' . $fileName;
    }
    if (empty($ten_hh) == true || empty($gia) == true || empty($mo_ta) == true || empty($trang_thai) == true || empty($so_luong) == true || empty($ma_loai) == true || empty($dac_biet) == true) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("Location:/du_an_mau/admin/hang_hoa/edit.php?id=".$ma_kh);
        die;
    }
    pdo_execute($sql,$ten_hh,$gia,$mo_ta,$giam_gia,$img,$ngay_tao,$trang_thai,$so_luong,$ma_loai,$dac_biet,$ma_hh);
    header("location: \du_an_mau\admin\hang_hoa\list.php");
}else if (isset($_GET["id"])){
    $ma_hh = $_GET["id"];
    $sql = "DELETE FROM hang_hoa WHERE ma_hh = $ma_hh";
    pdo_execute($sql);
    header("location:\du_an_mau\admin\hang_hoa\list.php");
}
?>