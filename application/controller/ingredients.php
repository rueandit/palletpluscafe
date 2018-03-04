<?php

/**
 * Class Ingredients
 * This is a class for the Ingredient table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Ingredients extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/ingredients/index
     */
    public function index()
    {
        if (isset($_POST["submit_search_ingredient"])) {
            $name = $_POST["name"];
            $description = $_POST["description"];
            $amount = $_POST["amount"];
            $unit = $_POST["unit"];  
            $archived = $_POST["archived"];

            // do getFilteredIngredients() in model/model.php
            $ingredients = $this->model->getFilteredIngredients(
                $_POST["name"],
                $_POST["description"],
                $_POST["amount"],
                $_POST["unit"],  
                $_POST["archived"]
            );
        }
        else{
            $ingredients = $this->model->getAllIngredients();
            $name = "";
            $description = "";  
            $amount = "";
            $unit = "";
            $archived = "";
        }

        // getting all ingredients and amount of ingredients
        $amount_of_ingredients = $this->model->getAmountOfIngredients();

       // load views. within the views we can echo out $ingredients and $amount_of_ingredients easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/ingredients/index.php';
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
    public function addIngredient()
    {
        $images = $this->model->getAllImages();

        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/ingredients/add.php';
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
    public function submitIngredient()
    {
        // if we have POST data to create a new ingredient entry
        if (isset($_POST["submit_add_ingredient"])) {
            // do addIngredient() in model/model.php
            $this->model->addIngredient(
                $_POST["name"],
                $_POST["description"],
                $_POST["amount"],
                $_POST["unit"],  
                $_POST["archived"],
                $_POST["imageId"]
            );
        }

        // where to go after ingredient has been added
        header('location: ' . URL . 'ingredients/index');
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
    public function deleteIngredient($ingredient_id)
    {
        // if we have an id of a ingredient that should be deleted
        if (isset($ingredient_id)) {
            // do deleteIngredient() in model/model.php
            $this->model->deleteIngredient($ingredient_id);
        }

        // where to go after ingredient has been deleted
        header('location: ' . URL . 'ingredients/index');
    }

     /**
     * ACTION: editIngredient
     * This method handles what happens when you move to http://palletpluscafe/ingredients/editingredient
     * @param int $ingredient_id Id of the to-edit ingredient
     */
    public function editIngredient($ingredient_id)
    {
        // if we have an id of a ingredient that should be edited
        if (isset($ingredient_id)) {
            // do getIngredient() in model/model.php
            $ingredient = $this->model->getIngredient($ingredient_id);
            $images = $this->model->getAllImages();

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $ingredient easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/ingredients/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to ingredients index page (as we don't have a ingredient_id)
            header('location: ' . URL . 'ingredients/index');
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
    public function updateIngredient()
    {
        // if we have POST data to create a new ingredient entry
        if (isset($_POST["submit_update_ingredient"])) {
            // do updateIngredient() from model/model.php
            $this->model->updateIngredient(
                $_POST["ingredient_id"],
                $_POST["name"],
                $_POST["description"],
                $_POST["amount"],
                $_POST["unit"],  
                $_POST["archived"],
                $_POST["imageId"]
            );
        }

        // where to go after ingredient has been added
        header('location: ' . URL . 'ingredients/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        $amount_of_ingredients = $this->model->getAmountOfIngredients();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_ingredients;
    }

}
