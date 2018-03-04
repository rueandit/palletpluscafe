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
    public function getAllUsers()
    {
        $sql = "SELECT 
                id,
                username,
                userPassword,
                userType,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM users
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
     * Get all menus from database based on filters
     */
    public function getFilteredUsers($username, $userType, $archived)
    {
        // set to null if empty and trim single quote for wild card search
        if($username == '') { $nqusername = 'NULL'; $username = 'NULL'; } else {$nqusername = $username; $username = "'".$username."'"; }
        if($userType == '') { $nquserType = 'NULL'; $userType = 'NULL'; } else {$nquserType = $userType; $userType = "'".$userType."'";}
        if($archived == '') { $archived = 'NULL'; } else { $archived = "'".$archived."'"; }

        $sql = "SELECT 
                id,
                username,
                userPassword,
                userType,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM users
                WHERE (".$username." IS NULL OR username LIKE '%".$nqusername."%')
                    AND (".$userType." IS NULL OR userType LIKE '%".$nquserType."%')
                    AND (".$archived." IS NULL OR archived = ".$archived.")
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
    public function addUser($username, $userPassword, $userType, $archived)
    {
        $sql = "INSERT INTO users (
                username, 
                userPassword, 
                userType,
                archived
                ) 
                VALUES (
                :username, 
                :userPassword, 
                :userType,
                :archived
                )";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username, 
            ':userPassword' => $userPassword, 
            ':userType' => $userType,
            ':archived' => $archived
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a menu in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $menu_id Id of menu
     */
    public function deleteUser($user_id)
    {
        $sql = "UPDATE users SET archived = '1' WHERE id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a menu from database
     */
    public function getUser($user_id)
    {
        $sql = "SELECT 
                id,
                username,
                userPassword,
                userType,
                CASE WHEN archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM users
                WHERE id = :user_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

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
    public function updateUser($user_id, $username, $userPassword, $userType, $archived)
    {
        $sql = "UPDATE users 
            SET username = :username, 
            userPassword = :userPassword, 
            userType = :userType,
            archived = :archived 
            WHERE id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':username' => $username, 
            ':userPassword' => $userPassword, 
            ':userType' => $userType,
            ':archived' => $archived,
            ':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/menus.php for more)
     */
    public function getAmountOfUsers()
    {
        $sql = "SELECT COUNT(id) AS amount_of_users FROM users";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_users;
    }
}
