<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="frames">
        <?php
        require_once "./../html_css/html/header.php";
        ?>
        <form action="\du_an_mau\trang_chu\dao.php" method="post" style="width: 500px;margin: 0 0 519px 700px;" id="form_register">
            <br>
            <h1 style="text-align:center;color: #b22830;">LẤY LẠI MẬT KHẨU</h1>
            <div class="input-group flex-nowrap">
                <span class="btn btn-danger" id="addon-wrapping">Tài Khoản</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" id="ten_tk" name="ten_tk">
            </div>
            <br>
            <div class="input-group flex-nowrap">
                <span class="btn btn-danger" id="addon-wrapping">Email</span>
                <input type="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="addon-wrapping" id="email" name="email">
            </div>
            <br>
            <button type="submit" class="btn btn-outline-danger" name="forgot">Lấy lại mật khẩu</button>
            <a href="\du_an_mau\trang_chu\login.php" class="btn btn-outline-secondary">Hủy</a>
            <div class="d-grid gap-2 fw-bold text-danger text-center">
                <?php if (isset($_SESSION['error_forgot'])) {echo $_SESSION['error_forgot']; unset($_SESSION['error_forgot']);}?>
            </div>
        </form>
        <?php
        require_once "./../html_css/html/footer.html";
        ?>
    </div>
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
                    "email": {
                        required: true,
                        email:true 
                    },
                    "sdt": {
                        required: true,
                        minlength:10,
                        number: true
                    },
                },
                messages: {
                    "ten_tk": {
                        required: "Bắt buộc nhập username",
                        minlength: "Hãy nhập ít nhất 8 ký tự"
                    },
                    "email": {
                        required: "Bắt buộc nhập mail",
                        email: "Nhập đúng định dạng email"
                    },
                    "sdt": {
                        required: "Bắt buộc nhập số điện thoại",
                        minlength: "Bạn nhập thiếu số điện thoại",
                        number: "Nhập đúng định dạng số điện thoại"
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