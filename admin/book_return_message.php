<?php
require_once './dbconn.php';

$book_id = base64_decode($_GET['book_id']);
$student_id = base64_decode($_GET['student_id']);

$result = mysqli_query($conn, "UPDATE `issue_books` SET `book_return_message`='Plese Return' WHERE `book_id`='$book_id' AND `student_id`='$student_id'");
if ($result) {
    header('location: borrowed_book_student.php');
}
