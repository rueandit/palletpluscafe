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
     * Get all menus from database
     */
    public function getAllMenus()
    {
        $sql = "SELECT 
                menu.id,
                menuName,
                menuDescription,
                menuStatus,
                price,
                rating,
                menu.archived,
                menu_category.description as category,
                subCategory,
                menu_allergen.description as allergen
                FROM menu
                INNER JOIN menu_category
                ON menu_category.id = menu.categoryId
                INNER JOIN menu_allergen
                ON menu_allergen.id = menu.allergenId";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Get all menus from database based on filters
     */
    public function getFilteredMenus($menuName, $menuDescription, $menuStatus, $price, $rating, $archived, $category, $subCategory, $allergen)
    {
        $sql = "SELECT 
                menu.id,
                menuName,
                menuDescription,
                menuStatus,
                price,
                rating,
                menu.archived,
                menu_category.description as category,
                subCategory,
                menu_allergen.description as allergen
                FROM menu
                INNER JOIN menu_category
                ON menu_category.id = menu.categoryId
                INNER JOIN menu_allergen
                ON menu_allergen.id = menu.allergenId
                WHERE (:menuName IS NULL OR menuName LIKE '%:menuName%')
                    AND (:menuDescription IS NULL OR menuDescription LIKE '%:menuDescription%')
                    AND (:menuStatus IS NULL OR menuStatus = :menuStatus)
                    AND (:price IS NULL OR price LIKE '%:price%')
                    AND (:rating IS NULL OR rating = :rating)
                    AND (:archived IS NULL OR menu.archived = :archived)
                    AND (:categoryId IS NULL OR categoryId = :categoryId)
                    AND (:subCategory IS NULL OR subCategory = :subCategory) 
                    AND (:allergenId IS NULL OR allergenId = :allergenId)
                ";
        $query = $this->db->prepare($sql);
        $parameters = array(':menuName' => ($menuName ?: NULL), 
            ':menuDescription' => ($menuDescription ?: NULL), 
            ':menuStatus' => ($menuStatus ?: NULL), 
            ':price' => ($price ?: NULL), 
            ':rating' => ($rating ?: NULL), 
            ':archived' => ($archived ?: NULL), 
            ':categoryId' => ($category ?: NULL), 
            ':subCategory' => ($subCategory ?: NULL), 
            ':allergenId' => ($allergen ?: NULL));
        $query->execute($parameters);
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...

        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->fetchAll();
    }

    /**
     * Add a menu to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $menuName Name 
     * @param string $menuDescription Description
     * @param string $menuStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $allergenId Allergen
     * @param int $imageId Image
     * */
    public function addMenu($menuName, $menuDescription, $menuStatus, $price, $rating, $archived, $category, $subCategory, $allergen, $imageFile)
    {
        $sql = "INSERT INTO menu (
                menuName, 
                menuDescription, 
                menuStatus, 
                price, 
                rating, 
                archived, 
                categoryId, 
                subCategory,
                allergenId, 
                imageFile
                ) 
                VALUES (
                :menuName, 
                :menuDescription, 
                :menuStatus, 
                :price, 
                :rating, 
                :archived, 
                :categoryId, 
                :subCategory, 
                :allergenId, 
                :imageFile)";
        $query = $this->db->prepare($sql);
        $parameters = array(':menuName' => $menuName, 
            ':menuDescription' => $menuDescription, 
            ':menuStatus' => $menuStatus, 
            ':price' => $price, 
            ':rating' => $rating, 
            ':archived' => $archived, 
            ':categoryId' => $category, 
            ':subCategory' => $subCategory, 
            ':allergenId' => $allergen, 
            ':imageFile' => $imageFile
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a menu in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $menu_id Id of menu
     */
    public function deleteMenu($menu_id)
    {
        $sql = "UPDATE menu SET archived = '1' WHERE id = :menu_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':menu_id' => $menu_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a menu from database
     */
    public function getMenu($menu_id)
    {
        $sql = "SELECT 
                menu.id,
                menuName,
                menuDescription,
                menuStatus,
                price,
                rating,
                menu.archived,
                menu_category.id as category,
                subCategory,
                menu_allergen.id as allergen,
                imageFile
                FROM menu
                INNER JOIN menu_category
                ON menu_category.id = menu.categoryId
                INNER JOIN menu_allergen
                ON menu_allergen.id = menu.allergenId
                WHERE menu.id = :menu_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':menu_id' => $menu_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a menu in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $menuName Name 
     * @param string $menuDescription Description
     * @param string $menuStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $allergenId Allergen
     * @param int $imageId Image
     * @param int $menu_id Id
     */
    public function updateMenu($menu_id, $menuName, $menuDescription, $menuStatus, $price, $rating, $archived, $category, $subCategory, $allergen, $imageFile)
    {
        $sql = "UPDATE menu 
            SET menuName = :menuName, 
            menuDescription = :menuDescription, 
            menuStatus = :menuStatus, 
            price = :price, 
            rating = :rating, 
            archived = :archived, 
            categoryId = :categoryId, 
            subCategory = :subCategory, 
            allergenId = :allergenId, 
            imageFile = :imageFile 
            WHERE id = :menu_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':menuName' => $menuName, 
            ':menuDescription' => $menuDescription, 
            ':menuStatus' => $menuStatus, 
            ':price' => $price, 
            ':rating' => $rating, 
            ':archived' => $archived, 
            ':categoryId' => $category, 
            ':subCategory' => $subCategory, 
            ':allergenId' => $allergen, 
            ':imageFile' => $imageFile, 
            ':menu_id' => $menu_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/menus.php for more)
     */
    public function getAmountOfMenus()
    {
        $sql = "SELECT COUNT(id) AS amount_of_menus FROM menu";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_menus;
    }

    public function getAllCategories()
    {
        $sql = "SELECT 
                id,
                description 
                FROM menu_category";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }

    public function getAllAllergens()
    {
        $sql = "SELECT 
                id,
                description 
                FROM menu_allergen";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
}
