<?php
require_once './dbconn.php';
session_start();

$id = base64_decode($_GET['id']);
$get_data = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `id`='$id'");
$data = mysqli_fetch_assoc($get_data);
$admin_name = $data['name'];

$get_book_data = mysqli_query($conn, "SELECT `book_image` FROM `books` WHERE `liberyan_id`='$id'");
$book_data = mysqli_fetch_assoc($get_book_data);
// print_r($data['image']);
$query = "DELETE liberyan, books, issue_books
FROM liberyan
LEFT JOIN books ON (books.liberyan_id=liberyan.id)
LEFT JOIN issue_books ON (issue_books.liberyan_id=liberyan.id)
WHERE liberyan.id='$id' AND liberyan.status='inactive' ";
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
    unlink('./images/' . $data['image']);
    header('location: all_user.php');
}
