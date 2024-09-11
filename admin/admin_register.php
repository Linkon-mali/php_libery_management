<?php
require_once './dbconn.php';
session_start();
if (isset($_SESSION['admin_email'])) {
    header('location: index.php');
}

if (isset($_POST['admin_register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $input_error = array();
    if (empty($name)) {
        $input_error['name'] = 'The name field is requird';
    }
    if (empty($email)) {
        $input_error['email'] = 'The email field is requird!';
    }
    if (empty($phone)) {
        $input_error['phone'] = 'The phone number field is requird';
    }
    if (empty($password)) {
        $input_error['password'] = 'The password field is requird';
    }

    if (count($input_error) == 0) {
        $email_check = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `email`= '$email'");
        if (mysqli_num_rows($email_check) == 0) {
            $phone_check = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `phone`= '$phone'");
            if (mysqli_num_rows($phone_check) == 0) {
                if (strlen($password) >= 8) {
                    $row_check = mysqli_query($conn, "SELECT * FROM `liberyan`");
                    if (mysqli_num_rows($row_check) == 0) {
                        $password = md5($password);
                        $query = "INSERT INTO `liberyan`(`name`, `email`, `phone`, `password`, `status`) VALUES ('$name','$email', '$phone', '$password','active')";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            $_SESSION['data_insert_success'] = 'Data Insert Success!';
                            header('location: admin_login.php');
                        }
                    } else {
                        $password = md5($password);
                        $query = "INSERT INTO `liberyan`(`name`, `email`, `phone`, `password`, `status`) VALUES ('$name','$email', '$phone', '$password','inactive')";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            $_SESSION['data_insert_success'] = 'Data Insert Success!';
                            header('location: admin_login.php');
                        }
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
    <title>LMS Admin Page</title>
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../vendor/animate.css/animate.css">
    <!--SECTION css-->
    <link rel="stylesheet" href="../stylesheets/css/style.css">
</head>

<body>
    <div class="wrap">
        <div class="page-body animated slideInUp">
            <div class="logo">
                <h1 class="text-center">Admin Register From</h1>
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
                                    <input type="text" class="form-control" name="name" value="<?= isset($name) ? $name : '' ?>" placeholder="Name">
                                    <i class="fa fa-user"></i>
                                </span>
                                <label for="" class="error">
                                    <?php if (isset($input_error['name'])) {
                                        echo $input_error['name'];
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
                            <div class="form-group mt-md">
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
                                <input class="btn btn-primary btn-block" type="submit" name="admin_register" value="Register">

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
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="../vendor/jquery/jquery-1.12.3.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/nano-scroller/nano-scroller.js"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="../javascripts/template-script.min.js"></script>
    <script src="../javascripts/template-init.min.js"></script>
</body>

</html>