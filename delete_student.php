<?php
require_once './dbconn.php';

$id = base64_decode($_GET['id']);
// print_r($id);
// exit();

$result = mysqli_query($conn, "UPDATE `students` SET `status`='delete' WHERE `id`='$id'");
if ($result) {
    header('location: all_student.php');
}
