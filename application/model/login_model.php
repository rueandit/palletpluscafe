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
     * Get a menu from database
     */
    public function getUser($username)
    {
        $sql = "SELECT id, username, userPassword, userType FROM users WHERE username= :username LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

}
