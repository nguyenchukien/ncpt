<?php
session_start();
if(!isset($_SESSION['username'])){
header('Location:index.php');
exit();
	} 
$username = $_SESSION['username'];
$loi = '';
	if(isset($_POST['btndoimk'])){
		$passold = $_POST['passold'];
		$passnew_1 = $_POST['passnew_1'];
		$passnew_2 = $_POST['passnew_2'];
		$connect = new PDO ("mysql:host=localhost; dbname=phongncpt; charset=utf8", "root", "ncpt@dungchung");
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql="SELECT * FROM tbl_member WHERE username = ? AND pass = ? ";
		$stmt = $connect->prepare($sql);
		$stmt->execute([$username, $passold]);
		if ($stmt->rowCount()==0) {$loi.="Mật khẩu cũ không đúng";}
		if (strlen($passnew_1)<6) {$loi.=" Mật khẩu quá ngắn";}
		if ($passnew_1!=$passnew_2) {$loi.=" Mật khẩu mới không trùng nhau";}
		}
	if ($loi != ""){
		echo '<script type = "text/javascript">';
		echo "alert('$loi');";
		echo 'window.location.href = "change_pass.php "';
		echo '</script>';
		}
		if ($loi == ""){
			$connect = new PDO ("mysql:host=localhost; dbname=tendinhdanh; charset=utf8", "root", "ncpt@dungchung");
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if (isset($passnew_1) && $passnew_1 !=""){
				$sql = "UPDATE member SET pass = ? WHERE username = ?";
				$stmt = $connect->prepare($sql);
				$stmt->execute([$passnew_1, $username]);
				echo '<script type = "text/javascript">';
				echo "alert('đã cập nhật mật khẩu mới');";
				echo 'window.location.href = "logout.php "';
				echo '</script>';

			}

			}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
    <div class="login-box">
        <img src="img/logo.jpg" style="width:100%;" alt="">
        <h2>Thay đổi mật khẩu</h2>
        <form method="post">
            <div class="user-box">
                <input value="<?php echo $username ?>" type="text" name="username" required="">
                <label>Tên đăng nhập</label>
            </div>
            <div class="user-box">
                <input value="<?php if(isset($pass)==true) echo $pass ?>" type="password" name="passold" required="">
                <label>Mật khẩu cũ</label>
            </div>
            <div class="user-box">
                <input value="<?php if(isset($passnew_1)==true) echo $passnew_1 ?>" type="password" name="passnew_1"
                    required="">
                <label>Mật khẩu mới</label>
            </div>
            <div class="user-box">
                <input value="<?php if(isset($passnew_2)==true) echo $passnew_2 ?>" type="password" name="passnew_2"
                    required="">
                <label>Nhập lại mật khẩu mới</label>
            </div>
            <a href="">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" class="a" name="btndoimk">
                <!-- <button type="submit" class="a" name="btndoimk" value="doimk" >Đổi mật khẩu</button> -->
            </a>
        </form>
    </div>
</body>

</html>