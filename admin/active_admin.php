<?php
require_once './dbconn.php';

$id = base64_decode($_GET['id']);

$result = mysqli_query($conn, "UPDATE `liberyan` SET `status`='active' WHERE `id`='$id'");


if ($result) {
    header('location: all_user.php');
}
