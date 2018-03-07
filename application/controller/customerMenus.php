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
class CustomerMenus extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/menus/index
     */
    public function index()
    {
        if (isset($_POST["submit_search_menu"])) {
            $menuName = $_POST["menuName"];
            $menuDescription = $_POST["menuDescription"];  
            $menuStatus = $_POST["menuStatus"];
            $price = $_POST["price"];
            $rating = $_POST["rating"];
            $archived = $_POST["archived"];
            $categoryId = $_POST["category"];
            $subCategory = $_POST["subCategory"];
            $allergenId = $_POST["allergen"];

            // do getFilteredMenus() in model/model.php
            $menus = $this->model->getFilteredMenus(
                $_POST["menuName"],
                $_POST["menuDescription"],  
                $_POST["menuStatus"],
                $_POST["price"],
                $_POST["rating"],
                $_POST["archived"],
                $_POST["category"],
                $_POST["subCategory"],
                $_POST["allergen"]
            );
        }
        else{
            $menus = $this->model->getAllMenus();
            $menuName = "";
            $menuDescription = "";  
            $menuStatus = "";
            $price = "";
            $rating = "";
            $archived = "";
            $categoryId = "";
            $subCategory = "";
            $allergenId = "";
        }

        // getting all menus and amount of menus
        $amount_of_menus = $this->model->getAmountOfMenus();
        $categories = $this->model->getAllCategories();
        $allergens = $this->model->getAllAllergens();

       // load views. within the views we can echo out $menus and $amount_of_menus easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/customerMenus/index.php';
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
    public function addMenu()
    {
        $categories = $this->model->getAllCategories();
        $allergens = $this->model->getAllAllergens();

        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/menus/add.php';
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
    public function submitMenu()
    {
        // if we have POST data to create a new menu entry
        if (isset($_POST["submit_add_menu"])) {
            // do addMenu() in model/model.php
            $this->model->addMenu(
                $_POST["menuName"],
                $_POST["menuDescription"],  
                $_POST["menuStatus"],
                $_POST["price"],
                $_POST["rating"],
                $_POST["archived"],
                $_POST["category"],
                $_POST["subCategory"],
                $_POST["allergen"],
                $_POST["imageFile"]);
        }

        // where to go after menu has been added
        header('location: ' . URL . 'menus/index');
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
    public function deleteMenu($menu_id)
    {
        // if we have an id of a menu that should be deleted
        if (isset($menu_id)) {
            // do deleteMenu() in model/model.php
            $this->model->deleteMenu($menu_id);
        }

        // where to go after menu has been deleted
        header('location: ' . URL . 'menus/index');
    }

     /**
     * ACTION: editMenu
     * This method handles what happens when you move to http://palletpluscafe/menus/editmenu
     * @param int $menu_id Id of the to-edit menu
     */
    public function editMenu($menu_id)
    {
        // if we have an id of a menu that should be edited
        if (isset($menu_id)) {
            // do getMenu() in model/model.php
            $menu = $this->model->getMenu($menu_id);
            $categories = $this->model->getAllCategories();
            $allergens = $this->model->getAllAllergens();

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $menu easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/menus/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to menus index page (as we don't have a menu_id)
            header('location: ' . URL . 'menus/index');
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
    public function updateMenu()
    {
        // if we have POST data to create a new menu entry
        if (isset($_POST["submit_update_menu"])) {
            // do updateMenu() from model/model.php
            $this->model->updateMenu(
                $_POST['menu_id'],
                $_POST["menuName"], 
                $_POST["menuDescription"],  
                $_POST["menuStatus"],
                $_POST["price"],
                $_POST["rating"],
                $_POST["archived"],
                $_POST["category"],
                $_POST["subCategory"],
                $_POST["allergen"],
                $_POST["imageFile"]
            );
        }

        // where to go after menu has been added
        header('location: ' . URL . 'menus/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        $amount_of_menus = $this->model->getAmountOfMenus();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_menus;
    }

}
