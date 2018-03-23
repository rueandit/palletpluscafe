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
     * Get all orders from database
     */
    public function getDailySalesReport($startDate)
    {
        $sql = "SELECT
                    orders.id,
                    menu.menuName as menuName,
                    menu.price as price,
                    COUNT(orders.menuId) as quantity,
                    menu.price * COUNT(orders.menuId) as priceTotal
                FROM orders
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN orders_log
                ON orders_log.orderId = orders.id
                WHERE CAST(orders_log.createdDate AS DATE) = ".$startDate."
                AND orders_log.status = 'Completed'
                GROUP BY orders.menuId
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
     * Get all orders from database
     */
    public function getWeeklySalesReport($startDate)
    {
        $sql = "SELECT
                    orders.id,
                    DAYNAME(orders_log.createdDate) as dayOfWeek,
                    orders_log.createdDate,
                    menu.menuName as menuName,
                    menu.price as price,
                    COUNT(orders.menuId) as quantity,
                    menu.price * COUNT(orders.menuId) as priceTotal
                FROM orders
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN orders_log
                ON orders_log.orderId = orders.id
                WHERE WEEK(orders_log.createdDate) = WEEK(".$startDate.")
                AND orders_log.status = 'Completed'
                GROUP BY WEEKDAY(orders_log.createdDate), orders.menuId
                ORDER BY orders_log.createdDate ASC
                ";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getMonthlySalesReport($startDate)
    {
        $sql = "SELECT
                    orders.id,
                    MONTHNAME(orders_log.createdDate) as monthOrdered,
                    WEEK(orders_log.createdDate) as weekOrdered,
                    orders_log.createdDate,
                    menu.menuName as menuName,
                    menu.price as price,
                    COUNT(orders.menuId) as quantity,
                    menu.price * COUNT(orders.menuId) as priceTotal
                FROM orders
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN orders_log
                ON orders_log.orderId = orders.id
                WHERE MONTH(orders_log.createdDate) = MONTH(".$startDate.")
                AND orders_log.status = 'Completed'
                GROUP BY WEEK(orders_log.createdDate), orders.menuId
                ORDER BY orders_log.createdDate ASC
                ";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    
    public function getYearlySalesReport($startDate)
    {
        $sql = "SELECT
                    orders.id,
                    YEAR(orders_log.createdDate) as yearOrdered,
                    MONTHNAME(orders_log.createdDate) as monthOrdered,
                    orders_log.createdDate,
                    menu.menuName as menuName,
                    menu.price as price,
                    COUNT(orders.menuId) as quantity,
                    menu.price * COUNT(orders.menuId) as priceTotal
                FROM orders
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN orders_log
                ON orders_log.orderId = orders.id
                WHERE YEAR(orders_log.createdDate) = YEAR(".$startDate.")
                AND orders_log.status = 'Completed'
                GROUP BY MONTH(orders_log.createdDate), orders.menuId
                ORDER BY orders_log.createdDate ASC
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
     * Get all orders from database based on filters
     */
    public function getAllInventory()
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

        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
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
}
