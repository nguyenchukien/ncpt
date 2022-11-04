<?php
session_start();
require_once ('../connect/dbhelp.php');
if(!isset($_SESSION['username'])){
	header('Location:index.php');
}
$s_fullname = $s_nhiemVu = $s_tienDo = $s_duKien = $s_hoanThanh = $s_user_add = '';

if (!empty($_POST)) {
	$s_id = '';

	if (isset($_POST['fullname'])) {
		$s_fullname= $_POST['fullname'];
	}

	if (isset($_POST['nhiemVu'])) {
		$s_nhiemVu = $_POST['nhiemVu'];
	}

	if (isset($_POST['tienDo'])) {
		$s_tienDo = $_POST['tienDo'];
	}
	if (isset($_POST['duKien'])) {
		$s_duKien= $_POST['duKien'];
	}

    if (isset($_POST['hoanThanh'])) {
		$s_hoanThanh= $_POST['hoanThanh'];
	}

	if (isset($_POST['user_add'])) {
		$s_user_add = $_POST['user_add'];
	}

	if (isset($_POST['id'])) {
		$s_id = $_POST['id'];
	}
	$s_fullname = str_replace('\'', '\\\'', $s_fullname);
	$s_nhiemVu = str_replace('\'', '\\\'', $s_nhiemVu);
	$s_tienDo = str_replace('\'', '\\\'', $s_tienDo);
	$s_duKien = str_replace('\'', '\\\'', $s_duKien);
	$s_hoanThanh = str_replace('\'', '\\\'', $s_hoanThanh);
	$s_user_add  = str_replace('\'', '\\\'', $s_user_add);
	$s_id  = str_replace('\'', '\\\'', $s_id);
	

	if ($s_id != '') {
		//update
		$sql = "update tbl_nhiemvu set fullname = '$s_fullname', nhiemVu = '$s_nhiemVu', tienDo = '$s_tienDo', duKien = '$s_duKien', hoanThanh = '$s_hoanThanh', user_add = '$s_user_add' where id = " .$s_id;
	} else {
		//insert
		$sql = "insert into tbl_nhiemvu(fullname, nhiemVu, tienDo, duKien, hoanThanh, user_add) value ('$s_fullname', '$s_nhiemVu', '$s_tienDo', '$s_duKien', '$s_hoanThanh', '$s_user_add')";
	}

	// echo $sql;

	execute($sql);

	header('Location: nhiemvu.php');
	die();
}

$id = '';
if (isset($_GET['id'])) {
	$id          = $_GET['id'];
	$sql         = 'select * from tbl_nhiemvu where id = '.$id;
	$new = executeResult($sql);
	if ($new != null && count($new) > 0) {
		$std        = $new[0];
		$s_fullname = $std['fullname'];
		$s_nhiemVu      = $std['nhiemVu'];
		$s_tienDo  = $std['tienDo'];
		$s_duKien = $std['duKien'];
		$s_hoanThanh = $std['hoanThanh'];
        $s_hoanThanh = date("Y-m-d", strtotime($s_hoanThanh));
		$s_user_add  = $std['user_add'];
	} else {
		$id = '';
	}
}
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
                    Báo cáo nhiệm vụ
                </h1>
                <form method="post">
                    <div class="form-group">
                        <label for="usr">Họ và tên:</label>
                        <input type="text" name="id" value="<?=$id?>" style="display: none">
                        <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$s_fullname?>">
                    </div>
                    <div class="form-group">
                        <label for="usr">Nhiệm vụ:</label>
                        <input type="text" class="form-control" id="usr" name="nhiemVu" value="<?=$s_nhiemVu?>">
                    </div>
                    <div class="form-group">
                        <label for="usr">Tiến độ công việc:</label>
                        <input type="text" class="form-control" id="usr" name="tienDo"
                            value="<?=$s_tienDo?>">
                    </div>
                    <div class="form-group">
                        <label for="usr">Lịch hoàn thành:</label>
                        <input type="date" class="form-control" id="usr" name="hoanThanh"
                            value="<?=$s_hoanThanh?>">
                    </div>
					<div class="form-group">
                        <label for="usr">Dự kiến tháng sau:</label>
                        <input type="text" class="form-control" id="usr" name="duKien"
                            value="<?=$s_duKien?>">
                    </div>
                    <div class="form-group">
                        <label for="usr">User thay đổi:</label>
                        <input type="text" class="form-control" id="usr" name="user_add"
                            value="<?=$_SESSION['fullname']?>" readonly>
                    </div>
                    <div style="display: flex; justify-content: space-between">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div><!-- Main Col END -->
        </div>
    </div>

</body>

</html>