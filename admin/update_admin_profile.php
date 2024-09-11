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
$admin_image = $row['image'];


if (isset($_POST['update_admin'])) {
    $admin_email = $_SESSION['admin_email'];

    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $file = $_FILES['image']['name'];
    $file = explode('.', $file);
    $file_ext = end($file);
    $file_name = $name . $phone . '.' . $file_ext;
    // print_r($file_name);
    // exit();

    $result = mysqli_query($conn, "UPDATE `liberyan` SET `name`='$name',`phone`='$phone', `image`='$file_name' WHERE `email`= '$admin_email' ");
    if ($result) {
        unlink('./images/' . $admin_image);
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name);
        header('location: admin_profile.php');
    }
}
?>
<?php require_once './top_content.php' ?>
<!-- CONTENT -->
<div style="margin-top: 10px;" class="content">
    <!-- content HEADER -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                <li><i aria-hidden="true"></i><a href="">Admin Update</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div style="margin-top: 0px;" class="col-md-6 col-sm-offset-3">
        <div class="animated slideInUp">
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="number" class="form-control" name="phone" value="<?= $row['phone'] ?>" require>
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="file" class="form-control" name="image" value="">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="update_admin" value="Update Liberyan">

                            </div>
                            <div class="form-group text-center">
                                Have an account?, <a href="admin_login.php">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <?php require_once './bottom_content.php' ?>