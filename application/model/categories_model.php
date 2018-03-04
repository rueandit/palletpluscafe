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
     * Get all categories from database
     */
    public function getAllCategories()
    {
        $sql = "SELECT 
                id,
                code,
                description,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_category
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
     * Get all categories from database based on filters
     */
    public function getFilteredCategories($code, $description, $archived)
    {
        if($code == '') { $nqcode = 'NULL'; $code = 'NULL'; } else {$nqcode = $code; $code = "'".$code."'";}
        if($description == '') { $nqdescription = 'NULL'; $description = 'NULL'; } else {$nqdescription = $description; $description = "'".$description."'";}
        if($archived == '') { $archived = 'NULL'; } else {$archived = "'".$archived."'";}
        
        $sql = "SELECT 
                id,
                code,
                description,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_category
                WHERE (".$code." IS NULL OR code LIKE '%".$nqcode."%')
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
     * Add a category to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $categoryName Name 
     * @param string $categoryDescription Description
     * @param string $categoryStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $categoryId Category
     * @param int $imageId Image
     * */
    public function addCategory($code, $description, $archived)
    {
        $sql = "INSERT INTO menu_category (
                code,
                description,
                archived
                ) 
                VALUES (
                :code,
                :description,
                :archived
                )";
        $query = $this->db->prepare($sql);
        $parameters = array(':code' => $code, 
            ':description' => $description, 
            ':archived' => $archived
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a category in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $category_id Id of category
     */
    public function deleteCategory($category_id)
    {
        $sql = "UPDATE menu_category SET archived = '1' WHERE id = :category_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':category_id' => $category_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a category from database
     */
    public function getCategory($category_id)
    {
        $sql = "SELECT
                id,
                code,
                description,
                archived
                FROM menu_category
                WHERE menu_category.id = :category_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':category_id' => $category_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a category in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $categoryName Name 
     * @param string $categoryDescription Description
     * @param string $categoryStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $categoryId Category
     * @param int $imageId Image
     * @param int $category_id Id
     */
    public function updateCategory($category_id, $code, $description, $archived)
    {
        $sql = "UPDATE menu_category 
            SET code = :code,
                description = :description,
                archived = :archived
            WHERE id = :category_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':code' => $code, 
            ':description' => $description, 
            ':archived' => $archived,
            ':category_id' => $category_id 
            );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/categories.php for more)
     */
    public function getAmountOfCategories()
    {
        $sql = "SELECT COUNT(id) AS amount_of_categories FROM menu_category";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_categories;
    }
}
