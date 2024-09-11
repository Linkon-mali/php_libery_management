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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Borrowed Book Student</a></li>
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
                                    <th>Publication</th>
                                    <th>Book Auth Name</th>
                                    <th>Liberyan Name</th>
                                    <th>Issue Date</th>
                                    <th>Student Name</th>
                                    <th>Return MSG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db_info = mysqli_query($conn, "SELECT books.id, books.book_name, books.book_image, books.book_author_name, books.book_publication_name, issue_books.date_time, issue_books.book_return_message, issue_books.student_id AS std_id, liberyan.name, students.fname, students.lname
                                            FROM books 
                                            INNER JOIN issue_books ON books.id = issue_books.book_id
                                            INNER JOIN liberyan ON issue_books.liberyan_id = liberyan.id
                                            INNER JOIN students ON issue_books.student_id = students.id
                                            WHERE issue_books.book_return_date  = ' '");
                                $id = 1;
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?> <tr>
                                        <td><?= $id ?></td>
                                        <td><?= $row['book_name'] ?></td>
                                        <td><img style="width: 80px; height: 80px;" src="./book image/<?= $row['name'] . '/' . $row['book_image'] ?>" alt="Image"></td>
                                        <td><?= $row['book_publication_name'] ?></td>
                                        <td><?= $row['book_author_name'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= date('y-m-d', strtotime($row['date_time'])) ?></td>
                                        <td><?= $row['fname'] . ' ' . $row['lname'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['book_return_message']) { ?>
                                                <button class="btn btn-xs btn-warning" disabled> Already Send </button>
                                            <?php } else { ?>
                                                <a href="book_return_message.php?book_id=<?= base64_encode($row['id']) ?>&student_id=<?= base64_encode($row['std_id']) ?>" class="btn btn-xs btn-info"> Message Send</a>
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