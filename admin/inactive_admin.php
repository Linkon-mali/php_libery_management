<?php
require_once './dbconn.php';
session_start();

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
}
$login_status = $_SESSION['admin_status'];

// $page = explode('/', $_SERVER['PHP_SELF']);
// $page  = end($page);
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
                <li><i aria-hidden="true"></i><a href="javascript: avoid(0)">Inactive Users</a></li>
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
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Status date</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db_info = mysqli_query($conn, "SELECT * FROM `liberyan` where `status`='inactive'");
                                while ($row = mysqli_fetch_assoc($db_info)) {
                                ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['email'] ?></td>
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
                                        <td style="color: red;"><?= $row['status'] ?></td>
                                        <td><?= $row['datetime'] ?></td>
                                        <td>
                                            <?php
                                            if ($login_status == 'active') { ?>
                                                <a href="active_admin.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-info"><i class=" fa fa-pencil"></i> Active</a>
                                                <a href="delete_admin.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                            <?php } else { ?>
                                                <button class="btn btn-xs btn-info" disabled><i class=" fa fa-pencil"></i> Edit</button>
                                                <button class="btn btn-xs btn-danger" disabled><i class=" fa fa-pencil"></i> Delete</button>
                                            <?php } ?>
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
    <?php require_once './bottom_content.php' ?>