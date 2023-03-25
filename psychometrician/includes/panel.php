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

                <li>
                    <a href="courses.php"><i class="fa fa-graduation-cap"></i> Programs</a>
                <li>
                    <a href="questions.php"><i class="fa fa-pencil-square"></i> Questions</a>
                <li>
                    <a href="categories.php"><i class="fa fa-th-list"></i> Category</a>
                <li>
                    <!-- <a href="schedule.php"><i class="fa fa-bell"></i> Schedule</a> -->
               
                    <!-- <a href="grid.php"><i class="fa fa-check-square"></i> Passers</a>
                <li>
                    <a href="ae_student.php"><i class="fa fa-plus"></i> Add Students</a>
                <li>
                    <a href="students.php"><i class="fa fa-users"></i> Students List</a>
                <li>
                <?php } else { ?>
                    <li>
                    <a href="flot.php"><i class="fa fa-area-chart"></i> Results</a>
                <li>
               
                <?php } ?> -->

                <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
                <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                <li>
                </li>
        </ul>
    </div>
</div>