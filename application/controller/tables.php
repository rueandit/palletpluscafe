<?php

/**
 * Class Tables
 * This is a class for the Table table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Tables extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/tables/index
     */
    public function index()
    {
        Helper::authenticate();
        Helper::authorize("tables/index");
        if (isset($_POST["submit_search_table"])) {
            $name = $_POST["name"];
            $description = $_POST["description"];  
            $archived = $_POST["archived"];

            // do getFilteredTables() in model/model.php
            $tables = $this->model->getFilteredTables(
                $_POST["name"],
                $_POST["description"],  
                $_POST["archived"]
            );
        }
        else{
            $tables = $this->model->getAllTables();
            $name = "";
            $description = "";  
            $tableStatus = "";
            $archived = "";
        }

        // getting all tables and amount of tables
        $amount_of_tables = $this->model->getAmountOfTables();

       // load views. within the views we can echo out $tables and $amount_of_tables easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/tables/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addTable
     * This method handles what happens when you move to http://palletpluscafe/tables/addtable
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a table" form on tables/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to tables/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addTable()
    {
        Helper::authenticate();
        Helper::authorize("tables/addTable");
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/tables/add.php';
        require APP . 'view/_templates/footer.php';
    }

        /**
     * ACTION: addTable
     * This method handles what happens when you move to http://palletpluscafe/tables/addtable
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a table" form on tables/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to tables/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function submitTable()
    {
        Helper::authenticate();
        Helper::authorize("tables/submitTable");
        // if we have POST data to create a new table entry
        if (isset($_POST["submit_add_table"])) {
            // do addTable() in model/model.php
            $this->model->addTable(
                $_POST["name"],
                $_POST["description"],  
                $_POST["archived"]
            );
        }

        // where to go after table has been added
        header('location: ' . URL . 'tables/index');
    }

    /**
     * ACTION: deleteTable
     * This method handles what happens when you move to http://palletpluscafe/tables/deletetable
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a table" button on tables/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to tables/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $table_id Id of the to-delete table
     */
    public function deleteTable($table_id)
    {
        Helper::authenticate();
        Helper::authorize("tables/deleteTable");
        // if we have an id of a table that should be deleted
        if (isset($table_id)) {
            // do deleteTable() in model/model.php
            $this->model->deleteTable($table_id);
        }

        // where to go after table has been deleted
        header('location: ' . URL . 'tables/index');
    }

     /**
     * ACTION: editTable
     * This method handles what happens when you move to http://palletpluscafe/tables/edittable
     * @param int $table_id Id of the to-edit table
     */
    public function editTable($table_id)
    {
        Helper::authenticate();
        Helper::authorize("tables/editTable");
        // if we have an id of a table that should be edited
        if (isset($table_id)) {
            // do getTable() in model/model.php
            $table = $this->model->getTable($table_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $table easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/tables/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to tables index page (as we don't have a table_id)
            header('location: ' . URL . 'tables/index');
        }
    }
    
    /**
     * ACTION: updateTable
     * This method handles what happens when you move to http://palletpluscafe/tables/updatetable
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a table" form on tables/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to tables/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateTable()
    {
        Helper::authenticate();
        Helper::authorize("tables/updateTable");
        // if we have POST data to create a new table entry
        if (isset($_POST["submit_update_table"])) {
            // do updateTable() from model/model.php
            $this->model->updateTable(
                $_POST['table_id'],
                $_POST['name'],
                $_POST["description"], 
                $_POST["archived"]
            );
        }

        // where to go after table has been added
        header('location: ' . URL . 'tables/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        Helper::authenticate();
        Helper::authorize("tables/ajaxGetStats");
        $amount_of_tables = $this->model->getAmountOfTables();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_tables;
    }

}
