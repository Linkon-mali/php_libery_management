<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">All Books</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
        <div class="col-sm-12">
            <div class="panel">
                <div class="text-right mb-0"><a href="print_all_books.php" style="margin-bottom: 0px;" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Print</a></div>
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>Book publication</th>
                                    <th>Book Auth Name</th>
                                    <th>Book Quantity</th>
                                    <th>Book AV Quantity</th>
                                    <th>Book Price</th>
                                    <th>Liberyan Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db_info = mysqli_query($conn, "SELECT books.id, books.book_name, books.book_publication_name, books.book_author_name, books.book_qty, books.book_available_qty, books.book_price, liberyan.name 
                                FROM books 
                                INNER JOIN liberyan ON liberyan.id = books.liberyan_id ");
                                $id = 1;
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?>
                                    <tr>
                                        <td><?= $id ?></td>
                                        <td><?= $row['book_name'] ?></td>
                                        <td><?= $row['book_publication_name'] ?></td>
                                        <td><?= $row['book_author_name'] ?></td>
                                        <td><?= $row['book_qty'] ?></td>
                                        <td><?= $row['book_available_qty'] ?></td>
                                        <td><?= $row['book_price'] ?></td>
                                        <td><?= $row['name'] ?></td>
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