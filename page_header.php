 <?php
    require_once './dbconn.php';
    session_start();

    $student_email = $_SESSION['student_email'];
    $student_id = $_SESSION['student_id'];
    $db_info = mysqli_query($conn, "SELECT * FROM `students` WHERE `email`='$student_email'");
    $row = mysqli_fetch_assoc($db_info);

    $issue_book_info = mysqli_query($conn, "SELECT * FROM `issue_books` WHERE `student_id`='$student_id' AND `book_return_message`!=' ' AND `book_return_date`=' '");
    $issue_row = mysqli_num_rows($issue_book_info);

    ?>
 <div class="page-header">
     <!-- LEFTSIDE header -->
     <div class="leftside-header">
         <div class="logo">
             <a href="index.php">
                 <h3>LMS</h3>
             </a>
         </div>
         <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
             <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
         </div>
     </div>
     <!-- RIGHTSIDE header -->
     <div class="rightside-header">
         <div class="header-middle"></div>
         <!--SEARCH HEADERBOX-->
         <div class="header-section" id="search-headerbox">
             <input type="text" name="search" id="search" placeholder="Search...">
             <i class="fa fa-search search" id="search-icon" aria-hidden="true"></i>
             <div class="header-separator"></div>
         </div>
         <!--NOCITE HEADERBOX-->
         <div class="header-section hidden-xs" id="notice-headerbox">
             <!--check list-->
             <!--alerts notices-->
             <div class="notice" id="alerts-notice">
                 <i class="fa fa-bell-o" aria-hidden="true">
                     <?php
                        if ($issue_row > 0) { ?>
                         <span class="badge badge-xs badge-top-right x-danger"><?= $issue_row ?></span>
                     <?php }
                        ?>
                 </i>

                 <div class="dropdown-box basic">
                     <div class="drop-header">
                         <h3><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</h3>
                         <span class="badge x-danger b-rounded"><?= $issue_row ?></span>
                     </div>
                     <div class="drop-content">
                         <div class="widget-list list-left-element list-sm">
                             <ul>
                                 <li>
                                     <a href="issue_book_list.php">
                                         <div class="left-element"><i class="fa fa-warning color-warning"></i></div>
                                         <div class="text">
                                             <span class="title"><?= $issue_row ?> Book</span>
                                             <span class="subtitle">Return today</span>
                                         </div>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     <div class="drop-footer">
                         <a href="issue_book_list.php">See all notifications</a>
                     </div>
                 </div>
             </div>
             <div class="header-separator"></div>
         </div>
         <!--USER HEADERBOX -->
         <div class="header-section" id="user-headerbox">
             <div class="user-header-wrap">
                 <div class="user-photo">
                     <?php
                        if ($row['image']) { ?>
                         <img style="height: 45px; " alt="profile photo" src="images/<?= $row['image'] ?>" />
                     <?php
                        } else { ?>
                         <img alt="profile photo" src="images/people.png" />
                     <?php
                        }
                        ?>
                 </div>
                 <div class="user-info">
                     <span class="user-name"><?= ucwords($row['fname'] . ' ' . $row['lname']) ?></span>
                     <span class="user-profile">Student</span>
                 </div>
                 <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                 <i class="fa fa-minus icon-close" aria-hidden="true"></i>
             </div>
             <div class="user-options dropdown-box">
                 <div class="drop-content basic">
                     <ul>
                         <li> <a href="student_profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                         <li> <a href="update_student_profile.php"><i class="fa fa-lock" aria-hidden="true"></i> Update Profile</a></li>
                         <!-- <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Configurations</a></li> -->
                     </ul>
                 </div>
             </div>
         </div>
         <div class="header-separator"></div>
         <!--Log out -->
         <div class="header-section">
             <a href="student_logout.php" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
         </div>
     </div>
 </div>