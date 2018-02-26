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
        // if (isset($_POST["submit_user_login"])) {
        //     $verifyUser = $this->model->getUser($_POST["username"]);
        //     $verifyUser->
        //         if($verifyUser->username == $_POST["username"] && $verifyUser->password == $_POST["password"]){
        //             header('location: ' . URL . 'menus/index');
        //         }
        // }
        header('location: ' . URL . 'menus/index');
    }
}
