<?php
require_once './dbconn.php';
session_start();
if (isset($_SESSION['student_email'])) {
    header('location: index.php');
}

if (isset($_POST['student_register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $input_error = array();
    if (empty($fname)) {
        $input_error['fname'] = 'The first name field is requird';
    }
    if (empty($lname)) {
        $input_error['lname'] = 'The last name field is requird';
    }
    if (empty($email)) {
        $input_error['email'] = 'The email field is requird';
    }
    if (empty($phone)) {
        $input_error['phone'] = 'The phone number field is requird';
    }
    if (empty($password)) {
        $input_error['password'] = 'The password field is requird';
    }

    if (count($input_error) == 0) {
        $email_check = mysqli_query($conn, "SELECT * FROM `students` WHERE `email`= '$email'");
        if (mysqli_num_rows($email_check) == 0) {
            $phone_check = mysqli_query($conn, "SELECT * FROM `students` WHERE `phone`= '$phone'");
            if (mysqli_num_rows($phone_check) == 0) {
                if (strlen($password) >= 8) {
                    $password = md5($password);
                    $query = "INSERT INTO `students`(`fname`, `lname`, `email`, `phone`, `password`) VALUES ('$fname','$lname','$email','$phone','$password')";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        $_SESSION['data_insert_success'] = 'Data Insert Success!';
                        header('location: student_login.php');
                    } else {
                        $_SESSION['data_insert_error'] = 'Data Insert Error!';
                    }
                } else {
                    $password_len = "Password less than 8 Charecter";
                }
            } else {
                $phone_error = "This Phone Number Already Exists";
            }
        } else {
            $email_error = "This Email Address Already Exists";
        }
    }
}

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>LMS Project</title>
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
        <div class="page-body animated slideInUp">
            <div class="logo">
                <h1 class="text-center">Student Register From</h1>
                <?php if (isset($_SESSION['data_insert_error'])) {
                    echo '<div class="alert alert-warning">' . $_SESSION['data_insert_error'] . '</div>';
                } ?>
            </div>
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="fname" value="<?= isset($fname) ? $fname : '' ?>" placeholder="First Name">
                                    <i class="fa fa-user"></i>
                                </span>
                                <label for="" class="error">
                                    <?php if (isset($input_error['fname'])) {
                                        echo $input_error['fname'];
                                    } ?>
                                </label>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="lname" value="<?= isset($lname) ? $lname : '' ?>" placeholder="Last Name">
                                    <i class="fa fa-user"></i>
                                </span>
                                <label for="" class="error">
                                    <?php if (isset($input_error['lname'])) {
                                        echo $input_error['lname'];
                                    } ?>
                                </label>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" name="email" value="<?= isset($email) ? $email : '' ?>" placeholder="Email">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <label for="" class="error">
                                    <?php if (isset($input_error['email'])) {
                                        echo $input_error['email'];
                                    } ?>
                                    <?php if (isset($email_error)) {
                                        echo $email_error;
                                    } ?>
                                </label>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="phone" value="<?= isset($phone) ? $phone : '' ?>" placeholder="Phone">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <label for="" class="error">
                                    <?php if (isset($input_error['phone'])) {
                                        echo $input_error['phone'];
                                    } ?>
                                    <?php if (isset($phone_error)) {
                                        echo $phone_error;
                                    } ?>
                                </label>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <i class="fa fa-key"></i>
                                </span>
                                <label for="" class="error">
                                    <?php if (isset($input_error['password'])) {
                                        echo $input_error['password'];
                                    } ?>
                                    <?php if (isset($password_len)) {
                                        echo $password_len;
                                    } ?>
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="student_register" value="Register">

                            </div>
                            <div class="form-group text-center">
                                Have an account?, <a href="student_login.php">Sign In</a>
                            </div>
                        </form>
                    </div>
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