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
                    orders_log.tableId AS tableId,
                    customer_table.name AS tableName,
                    orders_log.createdDate,
                    orders_log.modifiedDate,
                    users.id AS userId,
                    users.username AS modifiedBy,
                    CASE WHEN orders.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM `orders`
                INNER JOIN orders_log
                ON orders_log.orderId = orders.id
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN customer_table
                ON customer_table.id = orders_log.tableId
                INNER JOIN users
                ON users.username = orders_log.modifiedBy
                ORDER BY orders_log.createdDate DESC
                ";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getViewFilteredOrders($tableId, $menuName, $status, $createdDate)
    {
        if($tableId == '') { $tableId = 'NULL'; } else {$tableId = "'".$tableId."'";}
        if($menuName == '') { $nqmenuName = 'NULL'; $menuName = 'NULL'; } else {$nqmenuName = $menuName; $menuName = "'".$menuName."'";}
        if($status == '') { $nqstatus = 'NULL'; $status = 'NULL'; } else {$nqstatus = $status; $status = "'".$status."'";}
        if($createdDate == '') { $createdDate = 'NULL'; } else {$createdDate = "'".$createdDate."'";}
        
        $sql = "SELECT
                    orders.id,
                    menu.id AS menuId,
                    menu.menuName,
                    orders.status,
                    CASE WHEN orders.paid = 0 THEN 'False' ELSE 'True' END AS paid,
                    CASE WHEN orders.cash = 0 THEN 'False' ELSE 'True' END AS cash,
                    orders_log.tableId AS tableId,
                    customer_table.name AS tableName,
                    orders_log.createdDate,
                    orders_log.modifiedDate,
                    users.id AS userId,
                    users.username AS modifiedBy,
                    CASE WHEN orders.archived = 0 THEN 'False' ELSE 'True' END AS archived
                FROM `orders`
                INNER JOIN orders_log
                ON orders_log.orderId = orders.id
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN customer_table
                ON customer_table.id = orders_log.tableId
                INNER JOIN users
                ON users.username = orders_log.modifiedBy
                WHERE (".$menuName." IS NULL OR menu.menuName LIKE '%".$nqmenuName."%')
                    AND (".$status." IS NULL OR orders.status LIKE '%".$nqstatus."%')
                    AND (".$createdDate." IS NULL OR CAST(orders_log.createdDate AS DATE) = ".$createdDate.")
                    AND (".$tableId." IS NULL OR orders.tableId = ".$tableId.")
                ORDER BY orders_log.createdDate DESC
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
                    AND (".$createdDate." IS NULL OR CAST(orders_log.createdDate AS DATE)= ".$createdDate.")
                    AND (".$modifiedDate." IS NULL OR CAST(orders_log.modifiedDate AS DATE) = ".$modifiedDate.")
                    AND (".$modifiedBy." IS NULL OR orders_log.modifiedBy = ".$modifiedBy.")
                    AND (".$tableId." IS NULL OR orders.tableId = ".$tableId.")
                    AND (".$archived." IS NULL OR orders.archived = ".$archived.")      
                ORDER BY orders_log.createdDate DESC
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

    public function confirmOrders($tableId, $orders, $maxId)
    {
        $maxId++;
        $sql = "INSERT INTO orders (tableId, menuId, status, paid, cash, archived ) VALUES";
        $sql2 = "INSERT INTO orders_log (action, orderId, tableId, menuId, status, paid, cash, archived, modifiedBy ) VALUES";
        foreach($orders as $order){
            $i=0;
            for($i=0; $i<$order->quantity; $i++){ 
                $menuId = $order->menuId;
                $status = 'Pending'; 
                $paid = 0; 
                $cash = 0; 
                $archived = 0;
                $orderId = $maxId++;
                $modifiedBy = $_SESSION["username"];

                $sql = $sql."(".$tableId.",".$menuId.",'".$status."',".$paid.",".$cash.",".$archived."),";
                $sql2 = $sql2."('added',".$orderId.",".$tableId.",".$menuId.",'".$status."',".$paid.",".$cash.",".$archived.",'".$modifiedBy."'),";
            }
        }
        $sql = rtrim($sql, ",").";";
        $query = $this->db->prepare($sql);
        $query->execute();

        $sql2 = rtrim($sql2, ",").";";
        $query = $this->db->prepare($sql2);
        $query->execute();
        
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
    }

    public function saveComplete($orders)
    {
        $sql = "";
        $sql2 = "INSERT INTO orders_log (action, orderId, tableId, menuId, status, paid, cash, archived, modifiedBy ) VALUES";
    
        foreach($orders as $order){
            $menuId = $order->menuId;
            $status = 'Completed'; 
            $paid = 1; 
            $cash = 1; 
            $archived = 0;
            $orderId = $order->id;
            $orderLogId = $order->ordersLogId;
            $modifiedBy = $_SESSION["username"];
            $tableId = $order->tableId;

            $sql = $sql."UPDATE orders SET paid=".$paid.",cash=".$cash.",status='Completed' WHERE id=".$orderId."; ";
            $sql2 = $sql2."('updated',".$orderLogId.",".$tableId.",".$menuId.",'".$status."',".$paid.",".$cash.",".$archived.",'".$modifiedBy."'),";
        }
    
        $query = $this->db->prepare($sql);
        $query->execute();

        $sql2 = rtrim($sql2, ",").";";
        $query = $this->db->prepare($sql2);
        $query->execute();
        
        //echo($sql);
        //echo($sql2);
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
    }
    
    public function getOrdersToComplete($tableId)
    {   
        $sql = "SELECT
                    orders.id,
                    customer_table.id as tableId,
                    customer_table.name as tableName,
                    menu.id as menuId,
                    menu.menuName as menuName,
                    menu.price as price,
                    COUNT(orders.menuId) as quantity,
                    menu.price * COUNT(orders.menuId) as priceTotal,
                    orders_log.orderId as ordersLogId
                FROM orders
                INNER JOIN menu
                ON menu.id = orders.menuId
                INNER JOIN customer_table
                ON customer_table.id = orders.tableId
                INNER JOIN orders_log 
                ON orders_log.orderId = orders.id
                WHERE orders.tableId = ".$tableId."
                GROUP BY orders.menuId
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

    public function getOrdersForPayment($tableId)
    {   
        $sql = "SELECT
                    orders.menuId as menuId,
                    orders.id,
                    orders.tableId as tableId,
                    orders_log.orderId as ordersLogId
                FROM orders
                INNER JOIN orders_log 
                ON orders_log.orderId = orders.id
                AND orders.status = 'For Payment'
                WHERE orders.tableId = ".$tableId."
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
    
    public function getNewPendingOrders()
    {
        $sql = "SELECT COUNT(id) AS orders_count FROM orders WHERE LCASE(status)=" . "LCASE('". OrderStatus::pending ."')";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch()->orders_count;
    }

    public function getNewReadyOrders()
    {
        $sql = "SELECT COUNT(id) AS orders_count FROM orders WHERE LCASE(status)=" . "LCASE('". OrderStatus::forServing ."')";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch()->orders_count;
    }

    public function getNewPaymentOrders()
    {
        $sql = "SELECT COUNT(id) AS orders_count FROM orders WHERE LCASE(status)=" . "LCASE('". OrderStatus::forPayment ."')";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch()->orders_count;
    }

    public function updateOrderStatus($order_id, $status){
        
        $sql = "UPDATE orders 
                SET status = :status
                WHERE id = :order_id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':status' => $status, 
            ':order_id' => $order_id
            );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
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

    public function getMaxOrderId()
    {
        $sql = "SELECT 
                    MAX(id) as maxId
                FROM orders
                ";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetch()->maxId;
    }
}
