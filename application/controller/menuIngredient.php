<?php

/**
 * Class MenuIngredient
 * This is a class for the Ingredient table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class MenuIngredient extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/ingredients/index
     */
    public function index()
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/index");
        if (isset($_POST["submit_search_menuIngredient"])) {
            $menuName = $_POST["menuName"];
            $ingredient = $_POST["ingredient"];
            $amount = $_POST["amount"];
            $archived = $_POST["archived"];

            // do getFilteredMenuIngredient() in model/model.php
            $menuIngredients = $this->model->getFilteredMenuIngredient(
                $_POST["menuName"],
                $_POST["ingredient"],
                $_POST["amount"],
                $_POST["archived"]
            );
        }
        else{
            $menuIngredients = $this->model->getAllMenuIngredient();
            $menuName = "";
            $ingredient = "";  
            $amount = "";
            $archived = "";
        }

        // getting all ingredients and amount of ingredients
        $amount_of_menu_ingredients = $this->model->getAmountOfMenuIngredient();

       // load views. within the views we can echo out $ingredients and $amount_of_ingredients easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/menuIngredient/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addIngredient
     * This method handles what happens when you move to http://palletpluscafe/ingredients/addingredient
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a ingredient" form on ingredients/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to ingredients/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addMenuIngredient()
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/addMenuIngredient");
        $ingredients = $this->model->getAllIngredients();
        $menus = $this->model->getAllMenus();

        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/menuIngredient/add.php';
        require APP . 'view/_templates/footer.php';
    }

        /**
     * ACTION: addIngredient
     * This method handles what happens when you move to http://palletpluscafe/ingredients/addingredient
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a ingredient" form on ingredients/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to ingredients/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function submitMenuIngredient()
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/submitMenuIngredient");
        // if we have POST data to create a new ingredient entry
        if (isset($_POST["submit_add_menuIngredient"])) {
            // do addIngredient() in model/model.php
            $this->model->addMenuIngredient(
                $_POST["menuId"],
                $_POST["ingredientId"],
                $_POST["amount"],
                $_POST["archived"]
            );
        }

        // where to go after ingredient has been added
        header('location: ' . URL . 'menuIngredient/index');
    }

    /**
     * ACTION: deleteIngredient
     * This method handles what happens when you move to http://palletpluscafe/ingredients/deleteingredient
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a ingredient" button on ingredients/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to ingredients/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $ingredient_id Id of the to-delete ingredient
     */
    public function deleteMenuIngredient($menuIngredient_id)
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/deleteMenuIngredient");
        // if we have an id of a ingredient that should be deleted
        if (isset($ingredient_id)) {
            // do deleteIngredient() in model/model.php
            $this->model->deleteMenuIngredient($ingredmenuIngredient_idient_id);
        }

        // where to go after ingredient has been deleted
        header('location: ' . URL . 'menuIngredient/index');
    }

     /**
     * ACTION: editIngredient
     * This method handles what happens when you move to http://palletpluscafe/ingredients/editingredient
     * @param int $ingredient_id Id of the to-edit ingredient
     */
    public function editMenuIngredient($menuIngredient_id)
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/editMenuIngredient");
        // if we have an id of a ingredient that should be edited
        if (isset($menuIngredient_id)) {
            // do getIngredient() in model/model.php
            $menuIngredient = $this->model->getMenuIngredient($menuIngredient_id);
            $ingredients = $this->model->getAllIngredients();
            $menus = $this->model->getAllMenus();
            
            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $ingredient easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/menuIngredient/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to ingredients index page (as we don't have a ingredient_id)
            header('location: ' . URL . 'menuIngredient/index');
        }
    }
    
    /**
     * ACTION: updateIngredient
     * This method handles what happens when you move to http://palletpluscafe/ingredients/updateingredient
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a ingredient" form on ingredients/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to ingredients/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateMenuIngredient()
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/updateMenuIngredient");
        // if we have POST data to create a new ingredient entry
        if (isset($_POST["submit_update_menuIngredient"])) {
            // do updateIngredient() from model/model.php
            $this->model->updateMenuIngredient(
                $_POST['menuIngredient_id'],
                $_POST["menuId"],
                $_POST["ingredientId"],
                $_POST["amount"],
                $_POST["archived"]
            );
        }

        // where to go after ingredient has been added
        header('location: ' . URL . 'menuIngredient/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        Helper::authenticate();
        Helper::authorize("menuIngredients/ajaxGetStats");
        $amount_of_ingredients = $this->model->getAmountOfMenuIngredient();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_ingredients;
    }

}
