<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['student_email'])) {
    header('location: admin_login.php');
}

$student_email = $_SESSION['student_email'];

$db_info = mysqli_query($conn, "SELECT * FROM `students` WHERE `email` = '$student_email'");
$row = mysqli_fetch_assoc($db_info);


if (isset($_POST['update_student'])) {
    $admin_email = $_SESSION['student_email'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];

    $file = $_FILES['image']['name'];
    $file = explode('.', $file);
    $file_ext = end($file);
    $file_name = $phone . '.' . $file_ext;


    $result = mysqli_query($conn, "UPDATE `students` SET `fname`='$fname',`lname`='$lname',`phone`='$phone', `image`='$file_name' WHERE `email`= '$student_email' ");

    if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name);
        header('location: student_profile.php');
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
        <div class="animated slideInDown">
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="fname" value="<?= $row['fname'] ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="lname" value="<?= $row['lname'] ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="number" class="form-control" name="phone" value="<?= $row['phone'] ?>">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span style="margin-left: 200px;">
                                    <?php
                                    if ($row['image']) { ?>
                                        <img style="width: 100px;" alt="profile photo" src="images/<?= $row['image'] ?>" />
                                    <?php
                                    } else { ?>
                                        <img style="width: 100px" alt=" profile photo" src="images/people.png" />
                                    <?php
                                    }
                                    ?>
                                </span>
                                <span class="input-with-icon">
                                    <input type="file" class="form-control" name="image" value="">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="update_student" value="Update Student">

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