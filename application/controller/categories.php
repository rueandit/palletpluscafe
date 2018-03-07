<?php

/**
 * Class Categories
 * This is a class for the Category table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Categories extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/categories/index
     */
    public function index()
    {
        Helper::authenticate();
        Helper::authorize("categories/index");
        if (isset($_POST["submit_search_category"])) {
            $code = $_POST["code"];
            $description = $_POST["description"];  
            $archived = $_POST["archived"];

            // do getFilteredCategories() in model/model.php
            $categories = $this->model->getFilteredCategories(
                $_POST["code"],
                $_POST["description"],  
                $_POST["archived"]
            );
        }
        else{
            $categories = $this->model->getAllCategories();
            $code = "";
            $description = "";  
            $categoryStatus = "";
            $archived = "";
        }

        // getting all categories and amount of categories
        $amount_of_categories = $this->model->getAmountOfCategories();

       // load views. within the views we can echo out $categories and $amount_of_categories easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/categories/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addCategory
     * This method handles what happens when you move to http://palletpluscafe/categories/addcategory
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a category" form on categories/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to categories/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addCategory()
    {
        Helper::authenticate();
        Helper::authorize("categories/addCategory");
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/categories/add.php';
        require APP . 'view/_templates/footer.php';
    }

        /**
     * ACTION: addCategory
     * This method handles what happens when you move to http://palletpluscafe/categories/addcategory
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a category" form on categories/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to categories/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function submitCategory()
    {
        Helper::authenticate();
        Helper::authorize("categories/submitCategory");
        // if we have POST data to create a new category entry
        if (isset($_POST["submit_add_category"])) {
            // do addCategory() in model/model.php
            $this->model->addCategory(
                $_POST["code"],
                $_POST["description"],  
                $_POST["archived"]
            );
        }

        // where to go after category has been added
        header('location: ' . URL . 'categories/index');
    }

    /**
     * ACTION: deleteCategory
     * This method handles what happens when you move to http://palletpluscafe/categories/deletecategory
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a category" button on categories/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to categories/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $category_id Id of the to-delete category
     */
    public function deleteCategory($category_id)
    {
        Helper::authenticate();
        Helper::authorize("categories/deleteCategory");
        // if we have an id of a category that should be deleted
        if (isset($category_id)) {
            // do deleteCategory() in model/model.php
            $this->model->deleteCategory($category_id);
        }

        // where to go after category has been deleted
        header('location: ' . URL . 'categories/index');
    }

     /**
     * ACTION: editCategory
     * This method handles what happens when you move to http://palletpluscafe/categories/editcategory
     * @param int $category_id Id of the to-edit category
     */
    public function editCategory($category_id)
    {
        Helper::authenticate();
        Helper::authorize("categories/editCategory");
        // if we have an id of a category that should be edited
        if (isset($category_id)) {
            // do getCategory() in model/model.php
            $category = $this->model->getCategory($category_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $category easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/categories/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to categories index page (as we don't have a category_id)
            header('location: ' . URL . 'categories/index');
        }
    }
    
    /**
     * ACTION: updateCategory
     * This method handles what happens when you move to http://palletpluscafe/categories/updatecategory
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a category" form on categories/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to categories/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateCategory()
    {
        Helper::authenticate();
        Helper::authorize("categories/updateCategory");
        // if we have POST data to create a new category entry
        if (isset($_POST["submit_update_category"])) {
            // do updateCategory() from model/model.php
            $this->model->updateCategory(
                $_POST['category_id'],
                $_POST['code'],
                $_POST["description"], 
                $_POST["archived"]
            );
        }

        // where to go after category has been added
        header('location: ' . URL . 'categories/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        Helper::authenticate();
        Helper::authorize("categories/ajaxGetStats");
        $amount_of_categories = $this->model->getAmountOfCategories();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_categories;
    }

}
