<?php
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=db_du_an;charset=utf8";
    $username = 'root';
    $password = '';
    $conn = new PDO($dburl, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function pdo_query($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    $rows = $stmt->fetchAll();
    return $rows;
    }
    catch(PDOException $e){
    throw $e;
    }
    finally{
    unset($conn);
    }
}
function pdo_execute($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    }
    catch(PDOException $e){
    throw $e;
    }
    finally{
    unset($conn);
    }
}   
function pdo_query_one($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
    }
    catch(PDOException $e){
    throw $e;
    }
    finally{
    unset($conn);
    }
} 
function pdo_query_value($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($sql_args);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return array_values($row)[0];
    }
    catch(PDOException $e){
    throw $e;
    }
    finally{
    unset($conn);
    }
    }
    
// // định nghĩa các biến toàn cục lưu đường dẫn
// $ROOT_URL = "/du_an_mau";
// $ADMIN_URL = $ROOT_URL . "/admin";
// $IMADE_URL = $ROOT_URL . "/img";

// //đường dẫn để upload ảnh
// $PATH_IMG = $_SERVER['DOCUMENT_ROOT'] . $IMAGE_URL;

// /**
//  * funcution save file hàm upload file
//  * @tham số: @fi8le tên của form imput file
//  * @tham số: #path_dir duopngfw dẫn thư mục upload file
//  * @return tên file upload 
//  * 
//  */
// function save_file($file, $path_dir){
//     $file_upload = $_FILES[$file];
//     $file_name = $file_upload['name'];
//     $path_file_dir =  $path_dir . $file_name;
//     move_upload_file($file_upload['tmp_name'], $path_file_dir);
//     return $file_name;
// }
?>