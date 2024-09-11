<?php
require_once './dbconn.php';
session_start();
$admin_id = $_SESSION['admin_id'];
$id = base64_decode($_GET['id']);
// print_r($id);
$get_data = mysqli_query($conn, "SELECT `name` FROM `liberyan` WHERE `id`='$admin_id'");
$liberyan_row = mysqli_fetch_assoc($get_data);
$liberyan_name = $liberyan_row['name'];

$get_data = mysqli_query($conn, "SELECT `book_image` FROM `books` WHERE `id`='$id'");
$image_name = mysqli_fetch_assoc($get_data);

$result = mysqli_query($conn, "DELETE FROM `books` WHERE `id` = $id");

if ($result) {
    unlink('./book image/' . $liberyan_name . '/' . $image_name['book_image']);
    header('location: all_books.php');
}
