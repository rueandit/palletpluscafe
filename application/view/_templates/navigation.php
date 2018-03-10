<nav class="navbar-inverse">
    <div class="container-fluid" id="navbar">
        <div class="row">  
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >  
                <div class="navbar-header" id="appBar">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="navbar-right logout">
                    <?php if (isset($_SESSION["username"])) echo '<a href="'. URL. 'login/userlogout" class="logout-button"><i class="fas fa-sign-out-alt"></i>Logout</a>' ?>
                </div>
            </div>
        </div>
    </div>
</nav>