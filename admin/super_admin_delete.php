<?php
require_once './dbconn.php';
session_start();

$login_email = $_SESSION['admin_email'];
$login_id = $_SESSION['admin_id'];

$get_data = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `id`='$login_id'");
$data = mysqli_fetch_assoc($get_data);
$admin_name = $data['name'];

$get_book_data = mysqli_query($conn, "SELECT `book_image` FROM `books` WHERE `liberyan_id`='$login_id'");
$book_data = mysqli_fetch_assoc($get_book_data);

$query = "DELETE liberyan, books, issue_books
FROM liberyan
LEFT JOIN books ON (books.liberyan_id=liberyan.id)
LEFT JOIN issue_books ON (issue_books.liberyan_id=liberyan.id)
WHERE liberyan.id='$login_id' AND liberyan.email='$login_email' ";
$result = mysqli_query($conn, $query);

if ($result) {
    // if folder is't an empty they can not be deleted.
    // here firstly deleted all files inside the Linkon Mali folder.
    $files = glob('book image/' . $admin_name . '/*'); //get all file names
    foreach ($files as $file) {
        if (is_file($file))
            unlink($file); //delete all files
    }
    // and then here is deleted linkon mali folder
    if (is_dir('book image')) {
        rmdir('book image/' . $admin_name); // Inside the 'book image' $admin_name folder is deleted
    } else {
        echo ("book image is not a directory");
    }
    // unlink('./book image/' . $book_data['book_image']);
    unlink('./images/' . $data['image']);
    session_destroy();
    header('location: admin_login.php');
}
