<style type="text/css">
    a {
        font-weight: 900;
    }

    span {
        color: #337ab7;
    }
</style>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <?php if ($_SESSION['Level'] !== 'Student') { ?>
                <li>
                    <a href="main.php"><i class="fa fa-tachometer"></i> Dashboard</a>
                </li>

                <!-- <li> -->
                    <!-- <a href="courses.php"><i class="fa fa-graduation-cap"></i> Programs</a> -->
                <!-- <li>
                    <a href="questions.php"><i class="fa fa-pencil-square"></i> Questions</a>
                <li>
                    <a href="categories.php"><i class="fa fa-th-list"></i> Category</a> -->
                <li>
                    <a href="ae_student.php"><i class="fa fa-plus"></i> Add Examinee</a>
                <li>
                    <a href="students.php"><i class="fa fa-users"></i> Examinee List</a>
                <li>
                    <a href="schedule.php"><i class="fa fa-bell"></i> Schedule</a>
                <li>
                    <a href="grid.php"><i class="fa fa-check-square"></i> Passers</a>
                <li>
                <?php } else { ?>
                    <li>
                    <a href="flot.php"><i class="fa fa-area-chart"></i> Results</a>
                <li>
               
                <?php } ?>

                <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
                <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                <!--<a href="#"><i class="fa fa-area-chart"></i>  Control<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="categories.php">Category</a>
                    </li>
                    <li>
                        <a href="questions.php">Questions</a>
                    </li>
                    <li>
                        <a href="courses.php">Courses</a>
                    </li>
                    <li>
                        <a href="schedule.php">Schedule</a>
                    </li>
                </ul>
                 /.nav-second-level 
            </li>
            <li>
                <a href="tables.php"><i class="fa fa-users"></i>  Examinee<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="ae_student.php">Add</a>
                    </li>
                    <li>
                        <a href="students.php">Show</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-file-text"></i>  Result<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.php">Result</a>
                    </li>
                    <li>
                        <a href="grid.php">Passers</a>
                    </li>
                </ul>
                /.nav-second-level 
            </li>
            <li>
                <a href="sms.php"><i class="fa fa-edit fa-fw"></i> SMS</a>
            </li> 
            <li>
                <a href="#"><i class="fa fa-cog"></i>  Manage<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="users.php">Manage Users</a>
                    </li>
                    <li>
                        <a href="settings.php">Manage Exam Timer</a>
                    </li>
                </ul>-->
                <!-- /.nav-second-level -->
                <li>
                </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>