<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['student_email'])) {
    header('location: student_login.php');
}
$student_id = $_SESSION['student_id'];
$book_id = base64_decode($_GET['id']);

// print_r($student_id);
// exit();

$db_info = mysqli_query($conn, "SELECT * FROM `books` WHERE `id` = '$book_id'");
$row = mysqli_fetch_assoc($db_info);
$liberyan_id = $row['liberyan_id'];

$Liberyan_info = mysqli_query($conn, "SELECT books.book_author_name, books.book_name, liberyan.name 
FROM books INNER JOIN liberyan ON books.liberyan_id = liberyan.id WHERE liberyan_id = '$liberyan_id'");
$liberyan_row = mysqli_fetch_assoc($Liberyan_info);

$name = $row['book_name'];
$image = $row['book_image'];
$author = $row['book_author_name'];
$publication = $row['book_publication_name'];
$quantity = $row['book_qty'];
$avquantity = $row['book_available_qty'];
$price = $row['book_price'];

$folderName = $liberyan_row['name'];

$issue_book_row = mysqli_query($conn, "SELECT * FROM `issue_books` WHERE `book_id`='$book_id' AND `student_id`='$student_id'");
$issue_book_result = mysqli_num_rows($issue_book_row);

if (isset($_POST['book_issue'])) {
    $book_id;
    $liberyan_id;
    $query = "INSERT INTO `issue_books`(`student_id`, `book_id`, `liberyan_id`) VALUES ('$student_id','$book_id', '$liberyan_id')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        mysqli_query($conn, "UPDATE `books` SET `book_available_qty`=`book_available_qty` - 1 WHERE `id`='$book_id'");
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
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
        <div class="col-sm-12 col-lg-8 col-lg-offset-2">
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="book_name">Book Name</label>
                                <input type="text" class="form-control" readonly id="book_name" value="<?= $name ?>">
                            </div>
                            <div class="form-group">
                                <label for="image">Book Image:</label>
                                <span>
                                    <img style="width: 50px;" src="./admin/book image/<?= $folderName . '/' . $image ?>" alt="">
                                </span>
                                <input type="file" class="form-control" id="image" disabled>
                            </div>
                            <div class="form-group">
                                <label for="book_author_name">Book Author Name</label>
                                <input type="text" class="form-control" readonly id="book_author_name" value="<?= $author ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_pb_name">Book PB Name</label>
                                <input type="text" class="form-control" readonly id="book_pb_name" value="<?= $publication ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_ab_qty">Book AB Quantity</label>
                                <input type="number" class="form-control" readonly id="book_ab_qty" value="<?= $avquantity ?>">
                            </div>
                            <div class="form-group">
                                <label for="book_ab_qty">Liberyan Name</label>
                                <input type="text" class="form-control" readonly id="book_ab_qty" value="<?= $liberyan_row['name'] ?>">
                            </div>
                            <div class="form-group">
                                <?php
                                if ($issue_book_result < 1) {
                                ?> <button type="submit" name="book_issue" class="btn btn-primary pull-right">Book Issue</button>
                                <?php
                                } else {
                                ?> <input type=”button” class="btn btn-warning pull-right" disabled="disabled" value="Allready Issued" />
                                <?php
                                }
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>
</div>
<?php require_once './bottom_content.php' ?>