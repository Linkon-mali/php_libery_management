<?php
if (!isset($_SESSION['admin_email'])) {
    header('location: admin_login.php');
}
$page = explode('/', $_SERVER['PHP_SELF']);
$page  = end($page);
// print_r($page);
// exit();
?>

<div class="left-sidebar">
    <!-- left sidebar HEADER -->
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">
            <h4>Navigation</h4>
        </div>
        <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <!-- NAVIGATION -->
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>
                <ul class="nav nav-left-lines" id="main-nav">
                    <!--HOME-->
                    <li class="<?= $page == 'index.php' ? 'active-item' : '' ?>"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                    <!--UI ELEMENTENTS-->
                    <li class="has-child-item close-item <?= ($page == 'all_user.php') || ($page == 'admin_add.php') || ($page == 'inactive_admin.php') ? 'open-item' : '' ?>">
                        <a><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'all_user.php' ? 'active-item' : '' ?>"><a href="all_user.php">All Users</a></li>
                            <li class="<?= $page == 'admin_add.php' ? 'active-item' : '' ?>"><a href="admin_add.php">Add Users</a></li>
                            <li class="<?= $page == 'inactive_admin.php' ? 'active-item' : '' ?>"><a href="inactive_admin.php">Inactive Users</a></li>
                        </ul>
                    </li>
                    <!--CHARTS-->
                    <li class="has-child-item close-item <?= ($page == 'all_student.php') || ($page == 'borrowed_book_student.php') || ($page == 'return_book_student.php') ? 'open-item' : '' ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Students</span> </a> <i class="fa-solid fa-user-graduate"></i>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'all_student.php' ? 'active-item' : '' ?>"><a href="all_student.php">All Students</a></li>
                            <li class="<?= $page == 'borrowed_book_student.php' ? 'active-item' : '' ?>"><a href="borrowed_book_student.php">Borroowd Book Students</a></li>
                            <li class="<?= $page == 'return_book_student.php' ? 'active-item' : '' ?>"><a href="return_book_student.php">Return Book Students</a></li>
                        </ul>
                    </li>
                    <!--FORMS-->
                    <li class="has-child-item close-item <?= ($page == 'all_books.php') || ($page == 'add_book.php') || ($page == 'admin_book.php') ? 'open-item' : '' ?>">
                        <a><i class="fa fa-columns" aria-hidden="true"></i><span>Books </span></a>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'all_books.php' ? 'active-item' : '' ?>"><a href="all_books.php">All Book</a></li>
                            <li class="<?= $page == 'admin_book.php' ? 'active-item' : '' ?>"><a href="admin_book.php">Admin Book</a></li>
                            <li class="<?= $page == 'add_book.php' ? 'active-item' : '' ?>"><a href="add_book.php">Add Book</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>