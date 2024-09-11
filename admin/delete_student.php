<?php
require_once './dbconn.php';

$id = base64_decode($_GET['id']);
// print_r($id);
// exit();

$get_data = mysqli_query($conn, "SELECT * FROM `students` WHERE `id`='$id'");
$image_name = mysqli_fetch_assoc($get_data);

$issue_book_data = mysqli_query($conn, "SELECT books.id, books.book_name, books.book_qty, books.book_available_qty, issue_books.student_id AS std_id
FROM books 
INNER JOIN issue_books ON books.id = issue_books.book_id 
INNER JOIN students ON issue_books.student_id = students.id 
WHERE issue_books.student_id = '$id';");

while ($row = mysqli_fetch_assoc($issue_book_data)) {
    if ($row['id']) {
        $book_id = $row['id'];
        mysqli_query($conn, "UPDATE `books` SET `book_available_qty`=`book_available_qty` + 1 WHERE `id`='$book_id'");
    }
}

mysqli_query($conn, "DELETE FROM `issue_books` WHERE `student_id`='$id'");
$result = mysqli_query($conn, "DELETE FROM `students` WHERE `id` = '$id'");
if ($result) {
    unlink('../images/' . $image_name['image']);
    header('location: all_student.php');
}
