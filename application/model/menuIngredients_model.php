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
     * Get all menu_ingredient from database
     */
    public function getAllMenuIngredient()
    {
        $sql = "SELECT 
                menu_ingredient.id,
                menu_ingredient.amount,
                ingredient.name AS ingredientName,
                ingredient.unit,
                menu.menuName,
                CASE WHEN menu_ingredient.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_ingredient
                INNER JOIN ingredient
                ON ingredient.id = menu_ingredient.ingredientId
                INNER JOIN menu
                ON menu.id = menu_ingredient.menuId
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
     * Get all menu_ingredient from database based on filters
     */
    public function getFilteredMenuIngredient($menuName, $ingredient, $amount, $archived)
    {
        if($menuName == '') { $nqmenuName = 'NULL'; $menuName = 'NULL'; } else {$nqmenuName= $menuName; $menuName = "'".$menuName."'";}
        if($ingredient == '') { $nqingredient = 'NULL'; $ingredient = 'NULL'; } else {$nqingredient = $ingredient; $ingredient = "'".$ingredient."'";}
        if($amount == '') { $nqamount = 'NULL'; $amount = 'NULL'; } else {$nqamount = $amount; $amount = "'".$amount."'";}
        if($archived == '') { $archived = 'NULL'; } else {$archived = "'".$archived."'";}
        
        $sql = "SELECT 
                menu_ingredient.id,
                menu_ingredient.amount,
                ingredient.name AS ingredientName,
                ingredient.unit,
                menu.menuName,
                CASE WHEN menu_ingredient.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_ingredient
                INNER JOIN ingredient
                ON ingredient.id = menu_ingredient.ingredientId
                INNER JOIN menu
                ON menu.id = menu_ingredient.menuId
                WHERE (".$menuName." IS NULL OR menu.menuName LIKE '%".$nqmenuName."%')
                    AND (".$ingredient." IS NULL OR ingredient.name LIKE '%".$nqingredient."%')
                    AND (".$amount." IS NULL OR menu_ingredient.amount LIKE '%".$nqamount."%')
                    AND (".$archived." IS NULL OR menu_ingredient.archived = ".$archived.")            
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
    public function addMenuIngredient($menuId, $ingredientId, $amount, $archived)
    {
        $sql = "INSERT INTO menu_ingredient (
                menuId,
                ingredientId,
                amount,
                archived
                ) 
                VALUES (
                :menuId,
                :ingredientId,
                :amount,
                :archived
                )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':menuId' => $menuId, 
            ':ingredientId' => $ingredientId, 
            ':amount' => $amount,
            ':archived' => $archived
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
    public function deleteMenuIngredient($menuIngredient_id)
    {
        $sql = "UPDATE menu_ingredient SET archived = '1' WHERE id = :ingredient_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':ingredient_id' => $ingredient_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a ingredient from database
     */
    public function getMenuIngredient($menuIngredient_id)
    {
        $sql = "SELECT 
                    menu_ingredient.id,
                    menu_ingredient.amount,
                    ingredient.id AS ingredientId,
                    ingredient.name AS ingredientName,
                    ingredient.unit,
                    menu.menuName,
                    menu.id AS menuId,
                    CASE WHEN menu_ingredient.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM menu_ingredient
                INNER JOIN ingredient
                ON ingredient.id = menu_ingredient.ingredientId
                INNER JOIN menu
                ON menu.id = menu_ingredient.menuId
                WHERE menu_ingredient.id = :menuIngredient_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':menuIngredient_id' => $menuIngredient_id);

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
    public function updateMenuIngredient($menuIngredient_id, $menuId, $ingredientId, $amount, $archived)
    {
        $sql = "UPDATE menu_ingredient 
                SET menuId = :menuId,
                ingredientId = :ingredientId,
                amount = :amount,
                archived = :archived
            WHERE id = :menuIngredient_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':menuId' => $menuId, 
            ':ingredientId' => $ingredientId,
            ':amount' => $amount, 
            ':archived' => $archived,
            ':menuIngredient_id' => $menuIngredient_id, 
            );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/menu_ingredient.php for more)
     */
    public function getAmountOfMenuIngredient()
    {
        $sql = "SELECT COUNT(id) AS amount_of_menu_ingredient FROM menu_ingredient";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_menu_ingredient;
    }

    public function getAllIngredients()
    {
        $sql = "SELECT id, name FROM ingredient";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }

    public function getAllMenus()
    {
        $sql = "SELECT id, menuName FROM menu";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
}
