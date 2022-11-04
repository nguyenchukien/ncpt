<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'ncpt@dungchung', 'phongncpt') or die ('ko kết nối đc')
?>

<?php
if(!isset($_SESSION['username'])){
	header('Location:../index.php');
}
if(isset($_SESSION['level'])&&($_SESSION['level']==1)){
	header('Location:../user/user.php');
}
if(isset($_SESSION['tf'])&&($_SESSION['tf']==5)){
    echo '<script type = "text/javascript">';
    echo 'alert("User đang bị tạm khóa, liên lạc hotline trung tâm để được hỗ trợ");';
    echo 'window.location.href = "logout.php "';
    echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3> Xin chào quản trị viên: <p style="display: inline; color: red; text-align: center;">
            <?php echo $_SESSION['fullname'];?></p>
    </h3>
    <a href="../logout.php" style="padding-right: 30px"> Đăng
        xuất </a>
    <a href="../change_pass.php">Thay đổi mật khẩu</a>

</body>

</html>