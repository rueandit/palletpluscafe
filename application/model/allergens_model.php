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
     * Get all allergens from database
     */
    public function getAllAllergens()
    {
        $sql = "SELECT 
                id,
                code,
                description,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_allergen
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
     * Get all allergens from database based on filters
     */
    public function getFilteredAllergens($code, $description, $archived)
    {
        if($code == '') { $nqcode = 'NULL'; $code = 'NULL'; } else {$nqcode = $code; $code = "'".$code."'";}
        if($description == '') { $nqdescription = 'NULL'; $description = 'NULL'; } else {$nqdescription = $description; $description = "'".$description."'";}
        if($archived == '') { $archived = 'NULL'; } else {$archived = "'".$archived."'";}
        
        $sql = "SELECT 
                id,
                code,
                description,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_allergen
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
     * Add a allergen to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $allergenName Name 
     * @param string $allergenDescription Description
     * @param string $allergenStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $allergenId Allergen
     * @param int $imageId Image
     * */
    public function addAllergen($code, $description, $archived)
    {
        $sql = "INSERT INTO menu_allergen (
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
     * Delete a allergen in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $allergen_id Id of allergen
     */
    public function deleteAllergen($allergen_id)
    {
        $sql = "UPDATE menu_allergen SET archived = '1' WHERE id = :allergen_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':allergen_id' => $allergen_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a allergen from database
     */
    public function getAllergen($allergen_id)
    {
        $sql = "SELECT
                id,
                code,
                description,
                archived
                FROM menu_allergen
                WHERE menu_allergen.id = :allergen_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':allergen_id' => $allergen_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a allergen in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $allergenName Name 
     * @param string $allergenDescription Description
     * @param string $allergenStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $allergenId Allergen
     * @param int $imageId Image
     * @param int $allergen_id Id
     */
    public function updateAllergen($allergen_id, $code, $description, $archived)
    {
        $sql = "UPDATE menu_allergen 
            SET code = :code,
                description = :description,
                archived = :archived
            WHERE id = :allergen_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':code' => $code, 
            ':description' => $description, 
            ':archived' => $archived,
            ':allergen_id' => $allergen_id
            );
            
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/allergens.php for more)
     */
    public function getAmountOfAllergens()
    {
        $sql = "SELECT COUNT(id) AS amount_of_allergens FROM menu_allergen";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_allergens;
    }
}
