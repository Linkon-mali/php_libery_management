<?php
require_once './dbconn.php';
session_start();

if (isset($_SESSION['student_email'])) {
    header('location: index.php');
}

if (isset($_POST['student_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_check = mysqli_query($conn, "SELECT * FROM `students` WHERE `email` = '$email'");
    if (mysqli_num_rows($email_check) > 0) {
        $row = mysqli_fetch_assoc($email_check);
        if ($row['password'] == md5($password)) {
            if ($row['status'] == 'active') {
                $_SESSION['student_email'] = $email;
                $_SESSION['student_id'] = $row['id'];
                header('location: index.php');
            } else {
                $status_inactive = 'Your status is Deleted!';
            }
        } else {
            $wrong_password = 'Password does not match!';
        }
    } else {
        $username_not_found = 'This email not found!';
    }
}

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>LMS Project Student Part</title>
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.css">
    <!--SECTION css-->
    <link rel="stylesheet" href="stylesheets/css/style.css">
</head>

<body>
    <div class="wrap">
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body animated slideInDown">
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--LOGO-->
            <div class="logo">
                <h1 class="text-center">Student Login From</h1>
            </div>
            <div class="box">
                <?php if (isset($_SESSION['data_insert_success'])) { ?>
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button style="color: white;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                        <strong>Warning!</strong> .<?= $_SESSION['data_insert_success'] ?>.
                    </div>
                <?php } ?>
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" require name="email" value="<?php if (isset($email)) {
                                                                                                                echo $email;
                                                                                                            } ?>" placeholder="Enter Email">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" require name="password" placeholder="Password">
                                    <i class="fa fa-key"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="student_login" value="Student Login ">
                            </div>
                            <div class="form-group text-center">
                                <span>Don't have an account?</span>
                                <a href="student_register.php" class="btn btn-block mt-sm">Register</a>
                            </div>
                        </form>
                    </div>
                    <?php
                    if (isset($username_not_found)) {
                        echo '<div class="alert alert-danger  text-center">' . $username_not_found . '</div>';
                    }
                    if (isset($wrong_password)) {
                        echo '<div class="alert alert-danger  text-center">' . $wrong_password . '</div>';
                    }
                    if (isset($status_inactive)) {
                        echo '<div class="alert alert-danger text-center">' . $status_inactive . '</div>';
                    }
                    ?>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="vendor/jquery/jquery-1.12.3.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/nano-scroller/nano-scroller.js"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="javascripts/template-script.min.js"></script>
    <script src="javascripts/template-init.min.js"></script>
</body>

</html>