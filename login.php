<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'ncpt@dungchung', 'phongncpt') or die ('ko kết nối đc')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="classes/img/login.jpg" class="img-fluid" alt="Phone image" />
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="login.php" method="post">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example13">Username</label>
                            <input type="text" name="username" id="form1Example13" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example23">Password</label>
                            <input type="password" name="pass" id="form1Example23" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form1Example23">Nhập mã bảo mật</label>
                            <input type="text" name="captcha" id="form1Example23" class="form-control form-control-lg" style="width: 50%;"><img src="captcha/captcha.php"
                                title="" alt="" style="display: inline-block; " />
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="login">
                            Sign in
                        </button>



                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    if(isset($_SESSION['username'])){
        header('Location:user/user.php');
    }
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $captcha = $_POST['captcha'];
        $_SESSION['dem'] += 1;
        $dem = $_SESSION['dem'];
    $select = mysqli_query($conn, "SELECT * FROM tbl_member WHERE username = '$username' AND pass = '$pass' ");
    $row = mysqli_fetch_array($select);

    if(is_array($row) && $captcha== $_SESSION['captcha'] ){
        $_SESSION['username'] = $row ['username'];
        $_SESSION['pass'] = $row ['pass'];
        $_SESSION['level'] = $row ['level'];
        $_SESSION['fullname'] = $row ['fullname'];  
        $_SESSION['id'] = $row ['id'];
        header("location:user/index.php");      
    }    else {
        echo $dem;
        echo '<script type = "text/javascript">';
        echo 'alert("Sai thông tin đăng nhập, lưu ý quá 3 lần sẽ bị khóa tài khoản");';
        echo '</script>';
        if ($dem > 3){
            $sql = "update tbl_member set level = 5 where username = '$username'";
            mysqli_query($conn, $sql);
            $_SESSION['dem'] = 0;
        }
    }
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>