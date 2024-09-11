<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
}

$admin_email = $_SESSION['admin_email'];
$db_info = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `email` = '$admin_email'");
$row = mysqli_fetch_assoc($db_info);
$admin_name = $row['name'];
$admin_phone = $row['phone'];

?>
<div class="page-header">
    <!-- LEFTSIDE header -->
    <div class="leftside-header">
        <div class="logo">
            <a href="index.php">
                <h3>LMS</h3>
            </a>
        </div>
        <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <!-- RIGHTSIDE header -->
    <div class="rightside-header">
        <div class="header-middle"></div>
        <!--SEARCH HEADERBOX-->
        <div class="header-section" id="search-headerbox">
            <input type="text" name="search" id="search" placeholder="Search...">
            <i class="fa fa-search search" id="search-icon" aria-hidden="true"></i>
            <div class="header-separator"></div>
        </div>
        <!--USER HEADERBOX -->
        <div class="header-section" id="user-headerbox">
            <div class="user-header-wrap">
                <div class="user-photo">
                    <?php
                    if ($row['image']) { ?>
                        <img style="width: 30px; height: 30px;" alt="Profile photo" src="./images/<?= $row['image'] ?>" />
                    <?php
                    } else { ?>
                        <img style="width: 30px; height: 30px;" alt="Profile photo" src="./images/people.png" />
                    <?php
                    }
                    ?>
                </div>
                <div class="user-info">
                    <span class="user-name"><?= $row['name'] ?></span>
                    <span class="user-profile"><?= ($row['status'] == 'active') ? 'Super Admin' : 'Admin' ?></span>
                </div>
                <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                <i class="fa fa-minus icon-close" aria-hidden="true"></i>
            </div>
            <div class="user-options dropdown-box">
                <div class="drop-content basic">
                    <ul>
                        <li> <a href="admin_profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                        <li> <a href="update_admin_profile.php"><i class="fa fa-lock" aria-hidden="true"></i> Update Profile</a></li>
                        <li> <a href="super_admin_delete.php"><i style="color: red;" class="fa fa-trash" aria-hidden="true"></i> Delete Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-separator"></div>
        <!--Log out -->
        <div class="header-section">
            <a href="admin_logout.php" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
        </div>
    </div>
</div>