<?php
require_once './dbconn.php';
session_start();

$student_email = $_SESSION['student_email'];
$student_id = $_SESSION['student_id'];

?>

<?php require_once './top_content.php' ?>
<div style="margin-top: 20px;" class="content">
    <!-- content HEADER -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Student Profile</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInDown">
        <div class="col-sm-12 col-lg-12">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <div>
                        <div class="profile-photo">
                            <!-- <img style="width: 200px; height: 200px;" alt="User photo" src="images/people.png" /> -->
                            <?php
                            if ($row['image']) { ?>
                                <img style="width: 340px; height: 250px;" alt="Profile photo" src="images/<?= $row['image'] ?>" />
                            <?php
                            } else { ?>
                                <img style="width: 250px; height: 200px;" alt="Profile photo" src="images/people.png" />
                            <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <div style="margin-bottom: 10px;" class="user-header-info">
                            <?php
                            $db_info = mysqli_query($conn, "SELECT * FROM `students` WHERE `email` = '$student_email'");
                            $row = mysqli_fetch_assoc($db_info);
                            ?>
                            <h2 class="user-name"><?= ucwords($row['fname'] . ' ' . $row['lname']) ?> </h2>
                            <h5 class="user-position">Login Student</h5>
                            <div class="user-social-media">
                                <span class="text-lg">
                                    <a href="#" class="fa fa-twitter-square"></a> <a href="#" class="fa fa-facebook-square"></a> <a href="#" class="fa fa-linkedin-square"></a> <a href="#" class="fa fa-google-plus-square"></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
                        <div class="panel-content">
                            <h4 class=""><b>Contact Information</b></h4>
                            <ul class="user-contact-info ph-sm">
                                <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b> <?= $row['email'] ?></li>
                                <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> <?= $row['phone'] ?></li>
                                <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> <?= date("Y-M-d h:i:sa", strtotime($row['datetime'])) ?></li>
                                <li class="mt-sm">Lorem ipsum dolor sit amet, itaque maxime minumpore tenetur. Aperiam dolorum odio quo?</li>
                            </ul>
                        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                </div>
                <div class="col-md-6 col-lg-8">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--TIMELINE-->
                    <div class="animated fadeInDown">
                        <div class="panel">
                            <div class="panel-content">
                                <h4 class="section-subtitle text-center"><b>Browed Book list</b></h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Publication</th>
                                                <th>Author</th>
                                                <th>Liberyan</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $db_info = mysqli_query($conn, "SELECT books.id, books.book_name, books.book_image, books.book_author_name, books.book_publication_name, books.book_price, issue_books.date_time, liberyan.name 
                                            FROM books 
                                            INNER JOIN issue_books ON books.id = issue_books.book_id
                                            INNER JOIN liberyan ON issue_books.liberyan_id = liberyan.id
                                            WHERE issue_books.student_id = '$student_id' and issue_books.book_return_date = ''");
                                            while ($row = mysqli_fetch_assoc($db_info)) {
                                            ?> <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['book_name'] ?></td>
                                                    <td><img style="width: 80px; height: 80px;" src="./admin/book image/<?= $row['name'] . '/' . $row['book_image'] ?>" alt="Image"></td>
                                                    <td><?= $row['book_publication_name'] ?></td>
                                                    <td><?= $row['book_author_name'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= date('Y-m-d', strtotime($row['date_time'])) ?></td>
                                                    <td><?= $row['book_price'] ?></td>
                                                </tr>
                                            <?php
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
            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>
</div>
<?php require_once './bottom_content.php' ?>