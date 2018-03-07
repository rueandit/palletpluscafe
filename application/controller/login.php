<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Login extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/login/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/login/login.php';
        require APP . 'view/_templates/footer.php';
    }

    public function userlogin()
    {
        /// if we have an id of a menu that should be edited
        $_SESSION["login_error"] = "";
        if (isset($_POST["submit_user_login"])) {
            $verifyUser = $this->model->getUser($_POST["username"]);
            if($verifyUser){
                if($verifyUser->username == $_POST["username"] && $verifyUser->userPassword == $_POST["password"]){
                    $_SESSION["username"] = $verifyUser->username;
                    $_SESSION["user_type"] = $verifyUser->userType;
                    header('location: ' . URL . Helper::getLandingPage());
                }
                else{
                    $_SESSION["login_error"] = "Invalid Password";
                    header('location: ' . URL);
                }
            }
            else{
                $_SESSION["login_error"] = "Invalid Username";
                header('location: ' . URL);
            }
        }
    }

    public function userlogout(){
        session_destroy();
        header('location: ' . URL);
    }
}
