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
     * Get all ingredients from database
     */
    public function getAllIngredients()
    {
        $sql = "SELECT 
                ingredient.id,
                ingredient.name,
                ingredient.description,
                ingredient.amount,
                ingredient.unit,
                ingredient.amount,
                images.imageFile,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM ingredient
                LEFT JOIN images
                ON images.id = ingredient.imageId
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
     * Get all ingredients from database based on filters
     */
    public function getFilteredIngredients($name, $description, $amount, $unit, $archived)
    {
        if($name == '') { $nqname = 'NULL'; $name = 'NULL'; } else {$nqname = $name; $name = "'".$name."'";}
        if($description == '') { $nqdescription = 'NULL'; $description = 'NULL'; } else {$nqdescription = $description; $description = "'".$description."'";}
        if($amount == '') { $nqamount = 'NULL'; $amount = 'NULL'; } else {$nqamount = $amount; $amount = "'".$amount."'";}
        if($unit == '') { $nqunit = 'NULL'; $unit = 'NULL'; } else {$nqunit = $unit; $unit = "'".$unit."'";}
        if($archived == '') { $archived = 'NULL'; } else {$archived = "'".$archived."'";}
        
        $sql = "SELECT 
                ingredient.id,
                ingredient.name,
                ingredient.description,
                ingredient.amount,
                ingredient.unit,
                images.imageFile,
                CASE WHEN ingredient.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM ingredient
                LEFT JOIN images
                ON images.id = ingredient.imageId
                WHERE (".$name." IS NULL OR ingredient.name LIKE '%".$nqname."%')
                    AND (".$description." IS NULL OR ingredient.description LIKE '%".$nqdescription."%')
                    AND (".$amount." IS NULL OR ingredient.amount LIKE '%".$nqamount."%')
                    AND (".$unit." IS NULL OR ingredient.unit LIKE '%".$nqunit."%')
                    AND (".$archived." IS NULL OR ingredient.archived = ".$archived.")            
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
     * Add a ingredient to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $ingredientName Name 
     * @param string $ingredientDescription Description
     * @param string $ingredientStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $ingredientId Ingredient
     * @param int $imageId Image
     * */
    public function addIngredient($name, $description, $amount, $unit, $archived, $imageId)
    {
        $sql = "INSERT INTO ingredient (
                name,
                description,
                amount,
                unit,
                archived,
                imageId
                ) 
                VALUES (
                :name,
                :description,
                :amount,
                :unit,
                :archived,
                :imageId
                )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $name, 
            ':description' => $description,
            ':amount' => $amount,
            ':unit' => $unit, 
            ':archived' => $archived,
            ':imageId' => $imageId
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a ingredient in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $ingredient_id Id of ingredient
     */
    public function deleteIngredient($ingredient_id)
    {
        $sql = "UPDATE ingredient SET archived = '1' WHERE id = :ingredient_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':ingredient_id' => $ingredient_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a ingredient from database
     */
    public function getIngredient($ingredient_id)
    {
        $sql = "SELECT 
                ingredient.id,
                ingredient.name,
                ingredient.description,
                ingredient.amount,
                ingredient.unit,
                images.imageFile,
                ingredient.imageId,
                CASE WHEN ingredient.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM ingredient
                LEFT JOIN images
                ON images.id = ingredient.imageId
                WHERE ingredient.id = :ingredient_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':ingredient_id' => $ingredient_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a ingredient in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $ingredientName Name 
     * @param string $ingredientDescription Description
     * @param string $ingredientStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $ingredientId Ingredient
     * @param int $imageId Image
     * @param int $ingredient_id Id
     */
    public function updateIngredient($ingredient_id, $name, $description, $amount, $unit, $archived, $imageId)
    {
        $sql = "UPDATE ingredient 
                SET name = :name,
                description = :description,
                amount = :amount,
                unit = :unit,
                archived = :archived,
                imageId = :imageId
            WHERE id = :ingredient_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $name, 
            ':unit' => $unit,
            ':amount' => $amount,
            ':description' => $description, 
            ':archived' => $archived,
            ':imageId' => $imageId,
            ':ingredient_id' => $ingredient_id
            );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/ingredients.php for more)
     */
    public function getAmountOfIngredients()
    {
        $sql = "SELECT COUNT(id) AS amount_of_ingredients FROM menu_ingredient";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_ingredients;
    }

        /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/ingredients.php for more)
     */
    public function getAllImages()
    {
        $sql = "SELECT id, description FROM images";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
}
