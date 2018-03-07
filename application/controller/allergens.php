<?php

/**
 * Class Allergens
 * This is a class for the Allergen table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Allergens extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/allergens/index
     */
    public function index()
    {
        Helper::authenticate();
        Helper::authorize("allergens/index");
        if (isset($_POST["submit_search_allergen"])) {
            $code = $_POST["code"];
            $description = $_POST["description"];  
            $archived = $_POST["archived"];

            // do getFilteredAllergens() in model/model.php
            $allergens = $this->model->getFilteredAllergens(
                $_POST["code"],
                $_POST["description"],  
                $_POST["archived"]
            );
        }
        else{
            $allergens = $this->model->getAllAllergens();
            $code = "";
            $description = "";  
            $allergenStatus = "";
            $archived = "";
        }

        // getting all allergens and amount of allergens
        $amount_of_allergens = $this->model->getAmountOfAllergens();

       // load views. within the views we can echo out $allergens and $amount_of_allergens easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/allergens/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addAllergen
     * This method handles what happens when you move to http://palletpluscafe/allergens/addallergen
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a allergen" form on allergens/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to allergens/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addAllergen()
    {
        Helper::authenticate();
        Helper::authorize("allergens/addAllergen");
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/allergens/add.php';
        require APP . 'view/_templates/footer.php';
    }

        /**
     * ACTION: addAllergen
     * This method handles what happens when you move to http://palletpluscafe/allergens/addallergen
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a allergen" form on allergens/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to allergens/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function submitAllergen()
    {
        Helper::authenticate();
        Helper::authorize("allergens/submitAllergen");
        // if we have POST data to create a new allergen entry
        if (isset($_POST["submit_add_allergen"])) {
            // do addAllergen() in model/model.php
            $this->model->addAllergen(
                $_POST["code"],
                $_POST["description"],  
                $_POST["archived"]
            );
        }

        // where to go after allergen has been added
        header('location: ' . URL . 'allergens/index');
    }

    /**
     * ACTION: deleteAllergen
     * This method handles what happens when you move to http://palletpluscafe/allergens/deleteallergen
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a allergen" button on allergens/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to allergens/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $allergen_id Id of the to-delete allergen
     */
    public function deleteAllergen($allergen_id)
    {
        Helper::authenticate();
        Helper::authorize("allergens/deleteAllergen");
        // if we have an id of a allergen that should be deleted
        if (isset($allergen_id)) {
            // do deleteAllergen() in model/model.php
            $this->model->deleteAllergen($allergen_id);
        }

        // where to go after allergen has been deleted
        header('location: ' . URL . 'allergens/index');
    }

     /**
     * ACTION: editAllergen
     * This method handles what happens when you move to http://palletpluscafe/allergens/editallergen
     * @param int $allergen_id Id of the to-edit allergen
     */
    public function editAllergen($allergen_id)
    {
        Helper::authenticate();
        Helper::authorize("allergens/editAllergen");
        // if we have an id of a allergen that should be edited
        if (isset($allergen_id)) {
            // do getAllergen() in model/model.php
            $allergen = $this->model->getAllergen($allergen_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $allergen easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/allergens/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to allergens index page (as we don't have a allergen_id)
            header('location: ' . URL . 'allergens/index');
        }
    }
    
    /**
     * ACTION: updateAllergen
     * This method handles what happens when you move to http://palletpluscafe/allergens/updateallergen
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a allergen" form on allergens/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to allergens/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateAllergen()
    {
        Helper::authenticate();
        Helper::authorize("allergens/updateAllergen");
        // if we have POST data to create a new allergen entry
        if (isset($_POST["submit_update_allergen"])) {
            // do updateAllergen() from model/model.php
            $this->model->updateAllergen(
                $_POST["allergen_id"],
                $_POST['code'],
                $_POST["description"], 
                $_POST["archived"]
            );
        }

        // where to go after allergen has been added
        header('location: ' . URL . 'allergens/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        Helper::authenticate();
        Helper::authorize("allergens/ajaxGetStats");
        $amount_of_allergens = $this->model->getAmountOfAllergens();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_allergens;
    }

}
