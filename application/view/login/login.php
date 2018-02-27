<div class="login-container">
    <div class="form">
            <div id="login">   
            <h1>Welcome!</h1>  
            <label class="text-danger"><?php if (isset($_SESSION["login_error"])) echo $_SESSION["login_error"]; ?></label>
            <form action="<?php echo URL; ?>login/userlogin" method="post" autocomplete="off">       
                <div class="field-wrap1">
                <label class="login">
                Username<span class="req"> *</span>
                </label>
                <input class="login" type="username" autocomplete="off" name="username"/>
            </div>
            <div class="field-wrap2">
                <label class="login">
                Password<span class="req"> *</span>
                </label>
                <input class="login" type="password" autocomplete="off" name="password"/>
            </div>       
            <button class="button button-block" name="submit_user_login">LOGIN</button>         
            </form>
        </div><!-- tab-content -->
        
    </div> <!-- /form -->
</div>