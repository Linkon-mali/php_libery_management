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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Admin Books</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>Book Image</th>
                                    <th>Book publication</th>
                                    <th>Book Auth Name</th>
                                    <th>Book Quantity</th>
                                    <th>Book AV Qty</th>
                                    <th>Book Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db_info = mysqli_query($conn, "SELECT * FROM `books` WHERE `liberyan_id`='$admin_id'");
                                $id = 1;
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?>
                                    <tr>
                                        <td><?= $id ?></td>
                                        <td><?= $row['book_name'] ?></td>
                                        <td><img style="width: 80px; height: 80px;" src="./book image/<?= $admin_name . '/' . $row['book_image'] ?>" alt=""></td>
                                        <td><?= $row['book_publication_name'] ?></td>
                                        <td><?= $row['book_author_name'] ?></td>
                                        <td><?= $row['book_qty'] ?></td>
                                        <td><?= $row['book_available_qty'] ?></td>
                                        <td><?= $row['book_price'] ?></td>
                                        <td>
                                            <a href="update_book.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-warning">Edit</a>
                                            <a href="delete_book.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php $id++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once './bottom_content.php' ?>