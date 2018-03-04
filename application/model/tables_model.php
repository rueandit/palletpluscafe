<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all tables from database
     */
    public function getAllTables()
    {
        $sql = "SELECT 
                id,
                name,
                description,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM customer_table
                ";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Get all tables from database based on filters
     */
    public function getFilteredTables($name, $description, $archived)
    {
        if($name == '') { $nqname = 'NULL'; $name = 'NULL'; } else {$nqname = $name; $name = "'".$name."'";}
        if($description == '') { $nqdescription = 'NULL'; $description = 'NULL'; } else {$nqdescription = $description; $description = "'".$description."'";}
        if($archived == '') { $archived = 'NULL'; } else {$archived = "'".$archived."'";}
        
        $sql = "SELECT 
                id,
                name,
                description,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM customer_table
                WHERE (".$name." IS NULL OR name LIKE '%".$nqname."%')
                    AND (".$description." IS NULL OR description LIKE '%".$nqdescription."%')
                    AND (".$archived." IS NULL OR archived = ".$archived.")            
                ";
        $query = $this->db->prepare($sql);

        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...

        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->fetchAll();
    }

    /**
     * Add a table to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $tableName Name 
     * @param string $tableDescription Description
     * @param string $tableStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $tableId Table
     * @param int $imageId Image
     * */
    public function addTable($name, $description, $archived)
    {
        $sql = "INSERT INTO customer_table (
                name,
                description,
                archived
                ) 
                VALUES (
                :name,
                :description,
                :archived
                )";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, 
            ':description' => $description, 
            ':archived' => $archived
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a table in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $table_id Id of table
     */
    public function deleteTable($table_id)
    {
        
        $sql = "UPDATE customer_table SET archived = '1' WHERE id = :table_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':table_id' => $table_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a table from database
     */
    public function getTable($table_id)
    {
        $sql = "SELECT
                id,
                name,
                description,
                archived
                FROM customer_table
                WHERE customer_table.id = :table_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':table_id' => $table_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a table in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $tableName Name 
     * @param string $tableDescription Description
     * @param string $tableStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $tableId Table
     * @param int $imageId Image
     * @param int $table_id Id
     */
    public function updateTable($table_id, $name, $description, $archived)
    {
        $sql = "UPDATE customer_table 
                SET name = :name,
                description = :description,
                archived = :archived
            WHERE id = :table_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':table_id' => $table_id, 
            ':name' => $name, 
            ':description' => $description, 
            ':archived' => $archived 
            );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/tables.php for more)
     */
    public function getAmountOfTables()
    {
        $sql = "SELECT COUNT(id) AS amount_of_tables FROM customer_table";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_tables;
    }
}
