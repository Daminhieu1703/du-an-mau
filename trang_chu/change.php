<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="frames">
        <?php
        require_once "./../html_css/html/header.php";
        ?>
        <form action="\du_an_mau\trang_chu\dao.php" method="post" style="width: 500px;margin: 0 0 395px 700px;" id="form_register">
            <br>
            <h1 style="text-align:center;color: #b22830;">ĐỔI MẬT KHẨU</h1>
            <div class="input-group flex-nowrap">
                <span class="btn btn-danger" id="addon-wrapping">Tài Khoản</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" id="ten_tk" name="ten_tk">
            </div>
            <br>
            <div class="input-group flex-nowrap">
                <span class="btn btn-danger" id="addon-wrapping">Mật Khẩu</span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="addon-wrapping" id="mat_khau" name="mat_khau">
            </div>
            <br>
            <div class="input-group flex-nowrap">
                <span class="btn btn-danger" id="addon-wrapping">Nhập Lại Mật Khẩu</span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="addon-wrapping" id="re_mat_khau" name="re_mat_khau">
            </div>
            <br>
            <div class="input-group flex-nowrap">
                <span class="btn btn-danger" id="addon-wrapping">Mật Khẩu Mới</span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="addon-wrapping" id="mat_khau_moi" name="mat_khau_moi">
            </div>
            <br>
            <button type="submit" class="btn btn-outline-danger" name="change">Đổi Mật Khẩu</button>
            <a href="\du_an_mau\trang_chu\login.php" class="btn btn-outline-secondary">Hủy</a>
           <div class="d-grid gap-2 fw-bold text-danger text-center">
                <?php if (isset($_SESSION['error_pass'])) {echo $_SESSION['error_pass']; unset($_SESSION['error_pass']);}?>
           </div>
        </form>
        <?php
        require_once "./../html_css/html/footer.html";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>
        $().ready(function() {
            $("#form_register").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "ten_tk": {
                        required: true,
                        minlength: 9
                    },
                    "mat_khau": {
                        required: true,
                        minlength: 8
                    },
                    "re_mat_khau": {
                        equalTo: "#mat_khau",
                        minlength: 8
                        
                    },
                    "mat_khau_moi": {
                        required: true,
                        minlength: 8
                        
                    },
                },
                messages: {
                    "ten_tk": {
                        required: "Bắt buộc nhập username",
                        minlength: "Hãy nhập ít nhất 8 ký tự"
                    },
                    "mat_khau": {
                        required: "Bắt buộc nhập password",
                        minlength: "Hãy nhập ít nhất 8 ký tự"
                    },
                    "re_mat_khau": {
                        equalTo: "Hai password phải giống nhau",
                        minlength: "Hãy nhập ít nhất 8 ký tự"
                    },
                    "mat_khau_moi": {
                        required: "Bắt buộc nhập mật khẩu mới",
                        minlength: "Hãy nhập ít nhất 8 ký tự"
                    },
                },
            });
        });
    </script>
    <style>
        .error{
            color: red;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</body>
</html>