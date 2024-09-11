<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
}
$admin_email = $_SESSION['admin_email'];
$db_info = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `email` = '$admin_email'");
$row = mysqli_fetch_assoc($db_info);

if (isset($_POST['book_add'])) {
    // print_r($_POST);
    // exit();

    $admin_id = $row['id'];
    $admin_name = $row['name'];
    $book_name = $_POST['book_name'];
    $book_author_name = $_POST['book_author_name'];
    $book_publication_name = $_POST['book_publication_name'];
    $book_qty = $_POST['book_qty'];
    $book_available_qty = $_POST['book_available_qty'];
    $book_price = $_POST['book_price'];

    $file = $_FILES['image']['name'];
    $file = explode('.', $file);
    $file_ext = end($file);
    // $file_name = date("Y-m-d h:i:sa") . '.' . $file_ext;
    $file_name = $book_name . $admin_id . '.' . $file_ext;
    $path =  "./book image/" . $admin_name;
    mkdir($path);

    $query = "INSERT INTO `books`( `book_name`, `book_image`, `book_author_name`, `book_publication_name`, `book_qty`, `book_available_qty`, `book_price`, `liberyan_id`) VALUES ('$book_name','$file_name','$book_author_name','$book_publication_name','$book_qty','$book_available_qty','$book_price','$admin_id')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'book image/' . $admin_name . '/' . $file_name);
        header('location: admin_book.php');
    }
}

?>

<?php require_once './top_content.php' ?>
<!-- CONTENT -->
<div style="margin-top: 10px;" class="content">
    <!-- content HEADER -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Book Add</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div style="margin-top: 0px;" class="col-md-6 col-sm-offset-3">
        <div class="animated slideInUp">
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="book_name">Book Name</label>
                                <input type="text" class="form-control" name="book_name" id="book_name" placeholder="Book Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Book Image</label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="Book Image">
                            </div>
                            <div class="form-group">
                                <label for="book_author_name">Book Author Name</label>
                                <input type="text" class="form-control" name="book_author_name" id="book_author_name" placeholder="Book Author Name">
                            </div>
                            <div class="form-group">
                                <label for="book_pb_name">Book PB Name</label>
                                <input type="text" class="form-control" name="book_publication_name" id="book_pb_name" placeholder="Book Publication Name">
                            </div>
                            <div class="form-group">
                                <label for="book_qty">Book Quantity</label>
                                <input type="number" class="form-control" name="book_qty" id="book_qty" placeholder="Book Quantity">
                            </div>
                            <div class="form-group">
                                <label for="book_ab_qty">Book AB Quantity</label>
                                <input type="number" class="form-control" name="book_available_qty" id="book_ab_qty" placeholder="Book Available Quantity">
                            </div>
                            <div class="form-group">
                                <label for="book_price">Book Price</label>
                                <input type="number" class="form-control" name="book_price" id="book_price" placeholder="Book Price">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="book_add" class="btn btn-primary">Add Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>
<!-- CONTENT -->
<?php require_once './bottom_content.php' ?>