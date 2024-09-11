<?php
require_once './dbconn.php';

$id = base64_decode($_GET['id']);
// print_r($id);
// exit();

$get_data = mysqli_query($conn, "SELECT * FROM `students` WHERE `id`='$id'");
$image_name = mysqli_fetch_assoc($get_data);
$result = mysqli_query($conn, "DELETE FROM `students` WHERE `id` = '$id' AND `status`='delete'");
if ($result) {
    unlink('../images' . '/' . $image_name['image']);
    header('location: all_student.php');
}
