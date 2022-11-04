<!-- Sidebar -->
<div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
    <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar ' Menu' -->
    <!-- Bootstrap List Group -->
    <ul class="list-group">
        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <small>Phòng NCPT - Nhân Viên</small>
        </li>
        <!-- /END Separator -->
        <!-- Menu with submenu -->
        <a href="./index.php" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-dashboard fa-fw mr-3"></span>
                <span class="menu-collapsed">Trang chủ</span>
                <span class="submenu-icon ml-auto"></span>
            </div>
        </a>
        <a href="#submenu2" data-toggle="collapse" aria-expanded="false"
            class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-user fa-fw mr-3"></span>
                <span class="menu-collapsed">Thông tin cá nhân</span>
                <span class="submenu-icon ml-auto"></span>
            </div>
        </a>
        <!-- Submenu content -->
        <div id='submenu2' class="collapse sidebar-submenu">
            <a href="./user.php?id=<?php echo $id?>" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-info-circle fa-fw mr-3"></span>
                <span class="menu-collapsed">Sửa thông tin</span>
            </a>
            <a href="../change_pass.php" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-key fa-fw mr-3"></span>
                <span class="menu-collapsed">Thay đổi mật khẩu </span>
            </a>
        </div>
        <a href="./nhiemvu.php" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-tasks fa-fw mr-3"></span>
                <span class="menu-collapsed">Nhiệm vụ</span>
            </div>
        </a>
        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <small>Xin chào: <?php echo $_SESSION['fullname'];?></small>
        </li>
        <!-- /END Separator -->
        <a href="../logout.php" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-sign-out fa-fw mr-3"></span>
                <span class="menu-collapsed">Đăng xuất </span>
            </div>
        </a>
    </ul><!-- List Group END-->
</div><!-- sidebar-container END -->