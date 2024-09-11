<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
}
$admin_email = $_SESSION['admin_email'];
$admin_data = mysqli_query($conn, "SELECT * FROM `liberyan` WHERE `email`='$admin_email'");
$admin_row = mysqli_fetch_assoc($admin_data);
$admin_status = $admin_row['status'];
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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">All Student</a></li>
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
                                $id = 1;
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?>
                                    <tr>
                                        <td><?= $id ?></td>
                                        <td><?= ucwords($row['fname'] . ' ' . $row['lname']) ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['image']) { ?>
                                                <img style="width: 80px; height: 80px;" alt="Profile photo" src="../images/<?= $row['image'] ?>" />
                                            <?php
                                            } else { ?>
                                                <img style="width: 80px; height: 80px;" alt="Profile photo" src="../images/people.png" />
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row['datetime'] ?></td>
                                        <td>
                                            <?php
                                            if ($admin_status == 'active') {
                                                if ($row['status'] == 'delete') { ?>
                                                    <a href="deleted_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-danger">Deleted</a>
                                                    <a href="all_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-info">Undo</a>
                                                <?PHP } else { ?>
                                                    <a href="delete_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-warning">Delete</a>
                                                <?php }
                                            } else {
                                                if ($row['status'] == 'delete') { ?>
                                                    <a href="deleted_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-danger">Deleted</a>
                                                    <a href="all_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-info">Undo</a>
                                            <?PHP }
                                            }
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
    <?php
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
        // print_r($id);
        // exit();
        $result = mysqli_query($conn, "UPDATE `students` SET `status`=' ' WHERE `id`='$id'");
        if ($result) { ?>
            <script type="text/javascript">
                alert('Undo Successful');
                javascript: history.go(-1)
            </script>
        <?php } else { ?>
            <script type="text/javascript">
                alert('Undo faild');
            </script>
    <?php }
    }
    ?>
    <?php require_once './bottom_content.php' ?>