<?php
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
                    <!--CHARTS-->
                    <li class="has-child-item close-item <?= ($page == 'all_student.php') || ($page == 'add_student.php') ? 'open-item' : '' ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Students</span> </a>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'all_student.php' ? 'active-item' : '' ?>"><a href="all_student.php">All Students</a></li>
                            <li class="<?= $page == 'add_student.php' ? 'active-item' : '' ?>"><a href="add_student.php">Add Students</a></li>
                            <!-- <li><a href="">Return Book Students</a></li> -->
                        </ul>
                    </li>
                    <!--FORMS-->
                    <li class="has-child-item close-item <?= ($page == 'all_books.php') || ($page == 'issue_book_list.php') || ($page == 'return_book_list.php') ? 'open-item' : '' ?>">
                        <a><i class="fa fa-columns" aria-hidden="true"></i><span>Books </span></a>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'all_books.php' ? 'active-item' : '' ?>"><a href="all_books.php">All Books</a></li>
                            <li class="<?= $page == 'issue_book_list.php' ? 'active-item' : '' ?>"><a href="issue_book_list.php">Issue Book List</a></li>
                            <li class="<?= $page == 'return_book_list.php' ? 'active-item' : '' ?>"><a href="return_book_list.php">Return Book List</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>