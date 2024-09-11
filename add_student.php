<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['student_email'])) {
    header('location: student_login.php');
}


if (isset($_POST['student_add'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $password = md5($password);
    $query = "INSERT INTO `students`(`fname`, `lname`, `email`, `phone`, `password`) VALUES ('$fname','$lname','$email','$phone','$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location: all_student.php');
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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Student Add</a></li>
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
                                    <input type="text" class="form-control" name="fname" placeholder="First Name">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" name="email" placeholder="Eamil">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="number" class="form-control" name="phone" placeholder="Phone">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="number" class="form-control" name="password" placeholder="Password">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="student_add" value="Add Student">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <?php require_once './bottom_content.php' ?>