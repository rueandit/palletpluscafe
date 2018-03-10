<nav class="navbar-inverse">
    <div class="container-fluid" id="navbar">
        <div class="navbar-header" id="appBar">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="navbar-right">
            <div>
                <?php if (isset($_SESSION["username"])) echo '<a href="'. URL. 'login/userlogout"><span class="glyphicon glyphicon-log-out"></span>Logout</a>' ?>
            </div>
        </div>
    </div>
</nav>