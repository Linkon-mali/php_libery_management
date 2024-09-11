<?php
require_once './dbconn.php';
session_start();
$student_id = $_SESSION['student_id'];

$id = base64_decode($_GET['id']);
$book_return_date = date('Y-m-d');

$result = mysqli_query($conn, "UPDATE `issue_books` SET `book_return_date`='$book_return_date' WHERE `book_id`='$id' AND `student_id`='$student_id'");

if ($result) {
    mysqli_query($conn, "UPDATE `books` SET `book_available_qty`=`book_available_qty` + 1 WHERE `id`='$id'");
    header('location: issue_book_list.php');
}
