<nav class="navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header" onclick="toggleSideNav(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="navbar-right">
            <?php Helper::showNotificationIcon() ?>
            <div>
                <a href="<?php echo URL; ?>login/userlogout"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
            </div>
        </div>
    </div>
</nav>