<?php
require_once "./../db/function.php";
session_start();
extract($_REQUEST);
if (array_key_exists('them',$_REQUEST)) {
    $sql = "INSERT INTO loai_hang(ten_loai,mo_ta) VALUES(?,?)";
    if (empty($ten_loai) == true || empty($mo_ta) == true ) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("Location: /du_an_mau/admin/loai_hang/new.php");
        die;
    }
    pdo_query($sql,$ten_loai,$mo_ta);
    header("location: \du_an_mau\admin\loai_hang\list.php");
}elseif (array_key_exists('sua',$_REQUEST)) {
    $sql = "UPDATE loai_hang SET ten_loai = ? WHERE ma_loai = ?";
    if (empty($ten_loai) == true || empty($mo_ta) == true ) {
        $_SESSION['error_check'] = 'ĐIỀN THIẾU THÔNG TIN !';
        header("Location:/du_an_mau/admin/loai_hang/edit.php?id=".$ma_loai);
        die;
    }
    pdo_execute($sql,$ten_loai,$ma_loai);
    header("location: \du_an_mau\admin\loai_hang\list.php");
}elseif(isset($_GET['id'])){
    $sql = "DELETE FROM loai_hang WHERE ma_loai = ?";
    $ma_loai = $_GET['id'];
    pdo_execute($sql,$ma_loai);
    header("location: \du_an_mau\admin\loai_hang\list.php");
}
?>