<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
}

$admin_email = $_SESSION['admin_email'];
$db_info = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `email` = '$admin_email'");
$row = mysqli_fetch_assoc($db_info);
$admin_id = $row['id'];
$admin_name = $row['name'];

$id = base64_decode($_GET['id']);
$db_info = mysqli_query($conn, "SELECT * FROM `books` WHERE `id` = '$id'");
$row = mysqli_fetch_assoc($db_info);

$name = $row['book_name'];
$image = $row['book_image'];
$author = $row['book_author_name'];
$publication = $row['book_publication_name'];
$quantity = $row['book_qty'];
$avquantity = $row['book_available_qty'];
$price = $row['book_price'];

if (isset($_POST['update_book'])) {

    $book_name = $_POST['book_name'];
    $book_author_name = $_POST['book_author_name'];
    $book_publication_name = $_POST['book_publication_name'];
    $book_qty = $_POST['book_qty'];
    $book_available_qty = $_POST['book_available_qty'];
    $book_price = $_POST['book_price'];

    if (empty($_FILES['image']['name'])) {
        $file_name = $image;
    } else {
        $file = $_FILES['image']['name'];
        $file = explode('.', $file);
        $file_ext = end($file);
        $file_name = $book_name . $admin_id . '.' . $file_ext;
    }

    $query = "UPDATE `books` SET `book_name`='$book_name',`book_image`='$file_name',`book_author_name`='$book_author_name',`book_publication_name`='$book_publication_name',`book_qty`=' $book_qty',`book_available_qty`='$book_available_qty',`book_price`='$book_price' WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        unlink('./book image/' . $admin_name . $image);
        move_uploaded_file($_FILES['image']['tmp_name'], 'book image/' . $admin_name . '/' . $file_name);
        header('location: all_books.php');
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
                <li><i aria-hidden="true"></i><a href="">Book Add</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div style="margin-top: 0px;" class="col-md-6 col-sm-offset-3">
        <div class="animated slideInDown">
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="book_name">Book Name</label>
                                <input type="text" class="form-control" name="book_name" id="book_name" value="<?= $name ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Book Image:</label>
                                <span>
                                    <img style="width: 50px;" src="book image/<?= $admin_name . '/' . $image ?>" alt="">
                                </span>
                                <input type="file" class="form-control" id="image" name="image" value="Book Image">
                            </div>
                            <div class="form-group">
                                <label for="book_author_name">Book Author Name</label>
                                <input type="text" class="form-control" name="book_author_name" id="book_author_name" value="<?= $author ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_pb_name">Book PB Name</label>
                                <input type="text" class="form-control" name="book_publication_name" id="book_pb_name" value="<?= $publication ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_qty">Book Quantity</label>
                                <input type="number" class="form-control" name="book_qty" id="book_qty" value="<?= $quantity ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_ab_qty">Book AB Quantity</label>
                                <input type="number" class="form-control" name="book_available_qty" id="book_ab_qty" value="<?= $avquantity ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_price">Book Price</label>
                                <input type="number" class="form-control" name="book_price" id="book_price" value="<?= $price ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="update_book" class="btn btn-primary">Update Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <?php require_once './bottom_content.php' ?>