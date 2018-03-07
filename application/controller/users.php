<?php

/**
 * Class Menus
 * This is a class for the Menu table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Users extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/menus/index
     */
    public function index()
    {
        Helper::authenticate();
        Helper::authorize("users/index");
        if (isset($_POST["submit_search_users"])) {
            $username = $_POST["username"];
            $userType = $_POST["userType"];  
            $archived = $_POST["archived"];

            // do getFilteredMenus() in model/users_model.php
            $users = $this->model->getFilteredUsers(
                $_POST["username"],
                $_POST["userType"],  
                $_POST["archived"]
            );
        }
        else{
            $users = $this->model->getAllUsers();
            $username = "";
            $userType = "";  
            $archived = "";
        }

        // getting all menus and amount of menus
        $amount_of_users = $this->model->getAmountOfUsers();

       // load views. within the views we can echo out $menus and $amount_of_menus easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addMenu
     * This method handles what happens when you move to http://palletpluscafe/menus/addmenu
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a menu" form on menus/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to menus/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addUser()
    {
        Helper::authenticate();
        Helper::authorize("users/addUser");
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/users/add.php';
        require APP . 'view/_templates/footer.php';
    }

        /**
     * ACTION: addMenu
     * This method handles what happens when you move to http://palletpluscafe/menus/addmenu
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a menu" form on menus/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to menus/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function submitUser()
    {
        Helper::authenticate();
        Helper::authorize("users/submitUser");
        // if we have POST data to create a new menu entry
        if (isset($_POST["submit_add_user"])) {
            // do addUser() in model/model.php
            $this->model->addUser(
                $_POST["username"],
                $_POST["userPassword"],  
                $_POST["userType"],
                $_POST["archived"]);
        }

        // where to go after menu has been added
        header('location: ' . URL . 'users/index');
    }

    /**
     * ACTION: deleteMenu
     * This method handles what happens when you move to http://palletpluscafe/menus/deletemenu
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a menu" button on menus/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to menus/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $menu_id Id of the to-delete menu
     */
    public function deleteUser($user_id)
    {
        Helper::authenticate();
        Helper::authorize("users/deleteUser");
        // if we have an id of a menu that should be deleted
        if (isset($user_id)) {
            // do deleteMenu() in model/model.php
            $this->model->deleteUser($user_id);
        }

        // where to go after menu has been deleted
        header('location: ' . URL . 'users/index');
    }

     /**
     * ACTION: editMenu
     * This method handles what happens when you move to http://palletpluscafe/menus/editmenu
     * @param int $menu_id Id of the to-edit menu
     */
    public function editUser($user_id)
    {
        Helper::authenticate();
        Helper::authorize("users/editUser");
        // if we have an id of a menu that should be edited
        if (isset($user_id)) {
            // do getMenu() in model/model.php
            $user = $this->model->getUser($user_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $menu easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/users/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to menus index page (as we don't have a menu_id)
            // header('location: ' . URL . 'users/index');
        }
    }
    
    /**
     * ACTION: updateMenu
     * This method handles what happens when you move to http://palletpluscafe/menus/updatemenu
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a menu" form on menus/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to menus/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateUser()
    {
        Helper::authenticate();
        Helper::authorize("users/updateUser");
        // if we have POST data to create a new menu entry
        if (isset($_POST["submit_update_user"])) {
            // do updateMenu() from model/model.php
            $this->model->updateUser(
                $_POST['user_id'],
                $_POST["username"], 
                $_POST["userPassword"],  
                $_POST["userType"],
                $_POST["archived"]
            );
        }

        // where to go after menu has been added
        header('location: ' . URL . 'users/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        Helper::authenticate();
        Helper::authorize("users/ajaxGetStats");
        $amount_of_menus = $this->model->getAmountOfUsers();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_users;
    }

}
