<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['student_email'])) {
    header('location: student_login.php');
}
$student_id = $_SESSION['student_id'];

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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Issue Books</a></li>
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
                                    <th>Liberyan Name</th>
                                    <th>Issue Date</th>
                                    <th>Book Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db_info = mysqli_query($conn, "SELECT books.id, books.book_name, books.book_image, books.book_author_name, books.book_publication_name, books.book_price, issue_books.date_time, issue_books.book_return_message, liberyan.name 
                                    FROM books 
                                    INNER JOIN issue_books ON books.id = issue_books.book_id
                                    INNER JOIN liberyan ON issue_books.liberyan_id = liberyan.id
                                    WHERE issue_books.student_id = '$student_id' and issue_books.book_return_date = ''");
                                $id = 1;
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?> <tr>
                                        <td><?= $id ?></td>
                                        <td><?= $row['book_name'] ?></td>
                                        <td><img style="width: 80px; height: 80px;" src="./admin/book image/<?= $row['name'] . '/' . $row['book_image'] ?>" alt="Image"></td>
                                        <td><?= $row['book_publication_name'] ?></td>
                                        <td><?= $row['book_author_name'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['date_time'] ?></td>
                                        <td><?= $row['book_price'] ?></td>
                                        <td>
                                            <a href="return_book.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-info">Return Book</a>
                                            <br>
                                            <?php
                                            if ($row['book_return_message']) { ?>
                                                <button class="btn btn-xs btn-warning" disabled>Return Soon</button>
                                            <?php }
                                            ?>
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
</div>
<?php require_once './bottom_content.php' ?>