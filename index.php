<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['student_email'])) {
    header('location: student_login.php');
}
$student_id = $_SESSION['student_id'];

$liberyan_info = mysqli_query($conn, "SELECT * FROM `liberyan`");
$libery_row = mysqli_num_rows($liberyan_info);
$student_info = mysqli_query($conn, "SELECT * FROM `students`");
$student_row = mysqli_num_rows($student_info);
$book_info = mysqli_query($conn, "SELECT * FROM `books`");
$book_row = mysqli_num_rows($book_info);

?>

<?php require_once './top_content.php'; ?>
<!-- TOP CONTENT -->
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
        <div class="col-sm-12 col-lg-9">
            <div class="row">
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <!--WIDGETBOX-->
                <div class="col-sm-12 col-md-4">
                    <div class="panel widgetbox wbox-2 bg-scale-0">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-globe color-darker-1"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-dark-2">Total Student</h4>
                                        <h1 class="title color-primary"> <?= $student_row ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-users color-light-1"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-light-2">Total User</h4>
                                        <h1 class="title color-w"> <?= $libery_row ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="panel widgetbox wbox-2 bg-darker-2 color-light">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-book color-light-1"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-lighter-2">Total Book</h4>
                                        <h1 class="title color-light"> <?= $book_row ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <!--TABS WITH TABLET-->
                <div class="col-sm-12 col-md-8">
                    <div class="tabs mt-none">
                        <!-- Tabs Header -->
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#home" data-toggle="tab">Browed Book</a></li>
                            <li><a href="#profile" data-toggle="tab">Sells</a></li>
                            <li><a href="#messages" data-toggle="tab">Messages</a></li>
                            <li><a href="#settings" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                        </ul>
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Publication</th>
                                                <th>Author</th>
                                                <th>Liberyan</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $db_info = mysqli_query($conn, "SELECT books.book_name, books.book_image, books.book_author_name, books.book_publication_name, issue_books.date_time, liberyan.name 
                                            FROM books 
                                            INNER JOIN issue_books ON books.id = issue_books.book_id
                                            INNER JOIN liberyan ON issue_books.liberyan_id = liberyan.id
                                            WHERE issue_books.student_id = '$student_id' and issue_books.book_return_date = ''");
                                            while ($row = mysqli_fetch_assoc($db_info)) {
                                            ?> <tr>
                                                    <td><?= $row['book_name'] ?></td>
                                                    <td><img style="width: 80px; height: 80px;" src="./admin/book image/<?= $row['name'] . '/' . $row['book_image'] ?>" alt="Image"></td>
                                                    <td><?= $row['book_publication_name'] ?></td>
                                                    <td><?= $row['book_author_name'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= date('Y-m-d', strtotime($row['date_time'])) ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <p><b>Profile</b> content</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus
                                    nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla
                                    libero. Donec iaculis sit amet nibh non laoreet.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <p><b>Message</b> content</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus
                                    nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla
                                    libero. Donec iaculis sit amet nibh non laoreet.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <p><b>Settings</b> content</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus
                                    nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla
                                    libero. Donec iaculis sit amet nibh non laoreet.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <!--TO DO LIST-->
                <div class="col-sm-12 col-md-4">
                    <div class="panel b-primary bt-md">
                        <div class="panel-content p-none">
                            <div class="widget-list list-to-do">
                                <h4 class="list-title">To do List</h4>
                                <button class="add-item btn btn-o btn-primary btn-xs"><i class="fa fa-plus"></i></button>
                                <ul>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-h1" value="option1">
                                            <label class="check" for="check-h1">Accusantium eveniet ipsam neque</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-h2" value="option1" checked>
                                            <label class="check" for="check-h2">Lorem ipsum dolor sit</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-h3" value="option1">
                                            <label class="check" for="check-h3">Dolor eligendi in ipsum sapiente</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-h4" value="option1">
                                            <label class="check" for="check-h4">Natus recusandae vel</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-h5" value="option1">
                                            <label class="check" for="check-h5">Adipisci amet officia tempore ut</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-h6" value="option1">
                                            <label class="check" for="check-h6">Possimus repellat repellendus</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <!--AREA CHART-->
                <div class="col-sm-12 col-md-8">
                    <div class="panel">
                        <div class="panel-content">
                            <h5><b>First semester</b> Sells</h5>
                            <p class="section-text">Lorem ipsum <span class="highlight">dolor sit amet</span> consectetur adipisicing elit. Assumenda fugit inventore ipsam nam, qui voluptatibus</p>
                            <canvas id="area-chart" width="400" height="160"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--TIMELINE left-->
        <div class="col-sm-12 col-lg-3">
            <div class="timeline">
                <div class="timeline-box">
                    <div class="timeline-icon bg-primary">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="timeline-content">
                        <h4 class="tl-title">Ello impedit iusto</h4> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
                    </div>
                    <div class="timeline-footer">
                        <span>Today. 14:25</span>
                    </div>
                </div>
                <div class="timeline-box">
                    <div class="timeline-icon bg-primary">
                        <i class="fa fa-tasks"></i>
                    </div>
                    <div class="timeline-content">
                        <h4 class="tl-title">consectetur adipisicing </h4> Lorem ipsum dolor sit amet. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
                    </div>
                    <div class="timeline-footer">
                        <span>Today. 10:55</span>
                    </div>
                </div>
                <div class="timeline-box">
                    <div class="timeline-icon bg-primary">
                        <i class="fa fa-file"></i>
                    </div>
                    <div class="timeline-content">
                        <h4 class="tl-title">Impedit iusto minima nisi</h4> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
                    </div>
                    <div class="timeline-footer">
                        <span>Today. 9:20</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- BOTTOM CONTENT -->
<?php require_once './bottom_content.php'; ?>