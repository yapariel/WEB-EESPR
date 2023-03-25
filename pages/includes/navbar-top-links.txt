<ul class="nav navbar-top-links navbar-right">
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <?php if( isset( $_SESSION['entrance'] ) ): ?>
            <li>
                <a href="profile.php"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['entrance']['fname'].' '.$_SESSION['entrance']['lname'];?></a>
            </li>
            <?php endif; ?>
            <li class="divider"></li>
            <li>
                <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
