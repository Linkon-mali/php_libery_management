<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['student_email'])) {
    header('location: student_login.php');
}
$student_id = $_SESSION['student_id']

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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">All Students</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Emil</th>
                                    <th>Phone</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db_info = mysqli_query($conn, "SELECT * FROM `students`");
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= ucwords($row['fname'] . ' ' . $row['lname']) ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['image']) { ?>
                                                <img style="width: 80px; height: 80px;" alt="Profile photo" src="./images/<?= $row['image'] ?>" />
                                            <?php
                                            } else { ?>
                                                <img style="width: 80px; height: 80px;" alt="Profile photo" src="./images/people.png" />
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row['datetime'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 'delete') { ?>
                                                <a href="delete_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs disabled btn-danger">Deleted</a>
                                            <?PHP } else { ?>
                                                <a href="delete_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-warning">Delete</a>
                                            <?php }
                                            ?>
                                        </td>
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
<?php require_once './bottom_content.php' ?>