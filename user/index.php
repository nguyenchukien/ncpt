<?php
require_once ('../connect/dbhelp.php');
session_start();
$conn = mysqli_connect('localhost', 'root', 'ncpt@dungchung', 'phongncpt') or die ('ko kết nối đc')
?>

<?php
if(!isset($_SESSION['username'])){
	header('Location:../index.php');
}
if(isset($_SESSION['level'])&&($_SESSION['level']==0)){
	header('Location:../admin/admin.php');
}
if(isset($_SESSION['tf'])&&($_SESSION['tf']==5)){
    echo '<script type = "text/javascript">';
    echo 'alert("User đang bị tạm khóa, liên lạc hotline trung tâm để được hỗ trợ");';
    echo 'window.location.href = "logout.php "';
    echo '</script>';
}

$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <Script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <Script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"> </script>
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Bootstrap row -->
        <div class="row" id="body-row">
            <!-- MENU SIDEBAR-->
            <?php include_once('includes/sidebar.php');?>

            <!-- MAIN -->
            <div class="col">

                <h1>
                    Phòng NCPT - VNCERT/CC thông báo:
                </h1>
                <?php
                $query=mysqli_query($conn,"select id from tbl_nhiemvu where username = '$username' AND date(hoanThanh)>=(DATE(NOW()) - INTERVAL 7 DAY);");
                $count_nhiemVuHoanThanhTrongTuan=mysqli_num_rows($query);
                $query1=mysqli_query($conn,"select id from tbl_nhiemvu where username = '$username' AND date(ngayGiao)=CURDATE()-1;");
                $count_nhiemVuMoi=mysqli_num_rows($query1);
                $query2=mysqli_query($conn,"select id from tbl_nhiemvu where username = '$username' AND date(hoanThanh)<=CURDATE();");
                $count_nhiemVuQuaHan=mysqli_num_rows($query2);
                ?>
                <div class="row align-items-start">
                    <div class="col">
                        <h2><?php echo $count_nhiemVuHoanThanhTrongTuan;?></h2>
                        <span>Nhiệm vụ trong tuần phải hoàn thành</span>
                    </div>
                    <div class="col">
                        <h2><?php echo $count_nhiemVuMoi?></h2>
                        <span>Nhiệm vụ được phân công hôm qua</span>
                    </div>
                    <div class="col">
                        <h2><?php echo $count_nhiemVuQuaHan?></h2>
                        <span>Nhiệm vụ quá hạn</span>
                    </div>
                </div>
            </div><!-- Main Col END -->
        </div>
    </div>

</body>

</html>