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
    public function getAllOrders()
    {
        $sql = "SELECT
                    orders.id,
                    menu.id AS menuId,
                    menu.menuName,
                    orders.status,
                    CASE WHEN orders.paid = 0 THEN 'False' ELSE 'True' END AS paid,
                    CASE WHEN orders.cash = 0 THEN 'False' ELSE 'True' END AS cash,
                    customer_table.id AS tableId,
                    customer_table.name AS tableName,
                    orders_log.createdDate,
                    orders_log.modifiedDate,
                    users.id AS userId,
                    users.username AS modifiedBy,
                    CASE WHEN orders.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM `orders`
                LEFT JOIN orders_log
                ON orders_log.orderId = orders.id
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN customer_table
                ON customer_table.id = orders.tableId
                LEFT JOIN users
                ON users.id = orders_log.modifiedBy
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
    public function getFilteredOrders($tableId, $menuName, $status, $paid, $cash, $createdDate, $modifiedDate, $modifiedBy, $archived)
    {
        if($tableId == '') { $tableId = 'NULL'; } else {$tableId = "'".$tableId."'";}
        if($menuName == '') { $nqmenuName = 'NULL'; $menuName = 'NULL'; } else {$nqmenuName = $menuName; $menuName = "'".$menuName."'";}
        if($status == '') { $nqstatus = 'NULL'; $status = 'NULL'; } else {$nqstatus = $status; $status = "'".$status."'";}
        if($paid == '') { $paid = 'NULL'; } else {$paid = "'".$paid."'";}
        if($cash == '') { $cash = 'NULL'; } else {$cash = "'".$cash."'";}
        if($createdDate == '') { $createdDate = 'NULL'; } else {$createdDate = "'".$createdDate."'";}
        if($modifiedDate == '') { $modifiedDate = 'NULL'; } else {$modifiedDate = "'".$modifiedDate."'";}
        if($modifiedBy == '') { $modifiedBy = 'NULL'; } else {$modifiedBy = "'".$modifiedBy."'";}
        if($archived == '') { $archived = 'NULL'; } else {$archived = "'".$archived."'";}
        
        $sql = "SELECT
                    orders.id,
                    menu.id AS menuId,
                    menu.menuName,
                    orders.status,
                    CASE WHEN orders.paid = 0 THEN 'False' ELSE 'True' END AS paid,
                    CASE WHEN orders.cash = 0 THEN 'False' ELSE 'True' END AS cash,
                    customer_table.id AS tableId,
                    customer_table.name AS tableName,
                    orders_log.createdDate,
                    orders_log.modifiedDate,
                    users.id AS userId,
                    users.username AS modifiedBy,
                    CASE WHEN orders.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM `orders`
                LEFT JOIN orders_log
                ON orders_log.orderId = orders.id
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN customer_table
                ON customer_table.id = orders.tableId
                LEFT JOIN users
                ON users.id = orders_log.modifiedBy
                WHERE (".$menuName." IS NULL OR menu.menuName LIKE '%".$nqmenuName."%')
                    AND (".$status." IS NULL OR orders.status LIKE '%".$nqstatus."%')
                    AND (".$paid." IS NULL OR orders.paid = ".$paid.")
                    AND (".$cash." IS NULL OR orders.cash = ".$cash.")
                    AND (".$createdDate." IS NULL OR orders_log.createdDate = ".$createdDate.")
                    AND (".$modifiedDate." IS NULL OR orders_log.modifiedDate = ".$modifiedDate.")
                    AND (".$modifiedBy." IS NULL OR orders_log.modifiedBy = ".$modifiedBy.")
                    AND (".$tableId." IS NULL OR orders.tableId = ".$tableId.")
                    AND (".$archived." IS NULL OR orders.archived = ".$archived.")            
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
     * Add a order to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $orderName Name 
     * @param string $orderDescription Description
     * @param string $orderStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $orderId Order
     * @param int $imageId Image
     * */
    public function addOrder($tableId, $menuId, $status, $paid, $cash, $archived)
    {
        $sql = "INSERT INTO orders (
                tableId,
                menuId,
                status,
                paid,
                cash,
                archived
                ) 
                VALUES (
                :tableId,
                :menuId,
                :status,
                :paid,
                :cash,
                :archived
                )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':tableId' => $tableId, 
            ':menuId' => $menuId, 
            ':status' => $status, 
            ':paid' => $paid, 
            ':cash' => $cash, 
            ':archived' => $archived
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a order in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $order_id Id of order
     */
    public function deleteOrder($order_id)
    {
        $sql = "UPDATE orders SET archived = '1' WHERE id = :order_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':order_id' => $order_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a order from database
     */
    public function getOrder($order_id)
    {
        $sql = "SELECT
                    orders.id,
                    menu.id AS menuId,
                    menu.menuName,
                    orders.status,
                    CASE WHEN orders.paid = 0 THEN 'False' ELSE 'True' END AS paid,
                    CASE WHEN orders.cash = 0 THEN 'False' ELSE 'True' END AS cash,
                    customer_table.id AS tableId,
                    customer_table.name AS tableName,
                    orders_log.createdDate,
                    orders_log.modifiedDate,
                    users.id AS userId,
                    users.username AS modifiedBy,
                    CASE WHEN orders.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM `orders`
                LEFT JOIN orders_log
                ON orders_log.orderId = orders.id
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN customer_table
                ON customer_table.id = orders.tableId
                LEFT JOIN users
                ON users.id = orders_log.modifiedBy
                WHERE orders.id = :order_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':order_id' => $order_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a order in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $orderName Name 
     * @param string $orderDescription Description
     * @param string $orderStatus Status
     * @param float $price Price
     * @param string $rating Rating
     * @param bool $archived Archived
     * @param int $categoryId Category
     * @param int $orderId Order
     * @param int $imageId Image
     * @param int $order_id Id
     */
    public function updateOrder($order_id, $tableId, $menuId, $status, $paid, $cash, $archived)
    {
        $sql = "UPDATE orders 
                SET tableId = :tableId,
                menuId = :menuId,
                status = :status,
                paid = :paid,
                cash = :cash,
                archived = :archived
            WHERE id = :order_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':tableId' => $tableId, 
            ':menuId' => $menuId, 
            ':status' => $status, 
            ':paid' => $paid, 
            ':cash' => $cash, 
            ':archived' => $archived,
            ':order_id' => $order_id
            );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/orders.php for more)
     */
    public function getAmountOfOrders()
    {
        $sql = "SELECT COUNT(id) AS amount_of_orders FROM orders";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_orders;
    }

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

        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

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

    public function getAllMenus()
    {
        $sql = "SELECT 
                menu.id,
                menuName
                FROM menu
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
