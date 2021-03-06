<?php

/**
 * Class Orders
 * This is a class for the Order table.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Orders extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/orders/index
     */
    public function index()
    {
        Helper::authenticate();
        Helper::authorize("orders/index");

        $tables = $this->model->getAllTables();
        $menus = $this->model->getAllMenus();
        $_SESSION['createdDate'] = date("Y-m-d");
        $_SESSION['modifiedDate'] = date("Y-m-d");
        
        if (isset($_POST["submit_search_order"])) {
                $tableId = $_POST["tableId"];
                $menuName = $_POST["menuName"];  
                $status = $_POST["status"];
                $paid = $_POST["paid"];
                $cash = $_POST["cash"];
                $createdDate = '"'.$_POST["createdDate"].'"';
                $modifiedDate = '"'.$_POST["modifiedDate"].'"';
                $modifiedBy = $_POST["modifiedBy"];
                $archived = $_POST["archived"];

                $_SESSION['createdDate'] = date("Y-m-d");

            $orders = $this->model->getFilteredOrders(
                $tableId,
                $menuName,
                $status,
                $paid,
                $cash,
                $createdDate,
                $modifiedDate,
                $modifiedBy,
                $archived
            );
        }
        else if (isset($_POST["submit_limited_search_order"])) {
                $tableId = $_POST["tableId"];
                $menuName = $_POST["menuName"];  
                $status = $_POST["status"];
                $createdDate = $_POST["createdDate"];
                $modifiedDate = $_POST["modifiedDate"];
                
            $orders = $this->model->getViewFilteredOrders(
                $tableId,
                $menuName,
                $status,
                $createdDate
            );
        }
        else if ($_SESSION['user_type'] != 'admin' || $_SESSION['user_type'] != 'superadmin'){
            $tableId = '';
            $menuName = '';  
            $status = '';
            $createdDate = date("Y-m-d");
            $modifiedDate = date("Y-m-d");
            
            $orders = $this->model->getViewFilteredOrders(
                $tableId,
                $menuName,
                $status,
                $createdDate
            );
        }
        else{
            $orders = $this->model->getAllOrders();
            $tableId = '';
            $menuName = '';
            $status = ''; 
            $paid = '';
            $cash = '';
            $createdDate = '';
            $modifiedDate = '';
            $modifiedBy = '';
            $archived = '';
        }

        // getting all orders and amount of orders
        $amount_of_orders = $this->model->getAmountOfOrders();

        //change views per user type
        switch ($_SESSION['user_type']) {
            case UserType::waiter:
                require APP . 'view/orders/waiter_index.php';
                break;
            case UserType::kitchen:
                require APP . 'view/orders/kitchen_index.php';
                break;
            case UserType::cashier:
                require APP . 'view/orders/cashier_index.php';
                break;
            default:
                require APP . 'view/orders/index.php';
        }

       // load views. within the views we can echo out $orders and $amount_of_orders easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addOrder
     * This method handles what happens when you move to http://palletpluscafe/orders/addorder
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a order" form on orders/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to orders/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addOrder()
    {
        Helper::authenticate();
        Helper::authorize("orders/addOrder");
        $tables = $this->model->getAllTables();
        $menus = $this->model->getAllMenus();
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/orders/add.php';
        require APP . 'view/_templates/footer.php';
    }

        /**
     * ACTION: addOrder
     * This method handles what happens when you move to http://palletpluscafe/orders/addorder
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a order" form on orders/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to orders/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function submitOrder()
    {
        Helper::authenticate();
        Helper::authorize("orders/submitOrder");
        // if we have POST data to create a new order entry
        if (isset($_POST["submit_add_order"])) {
            // do addOrder() in model/model.php
            $this->model->addOrder(
                $_POST['tableId'],
                $_POST["menuId"],
                $_POST["status"],
                $_POST["paid"],
                $_POST["cash"], 
                $_POST["archived"]
            );
        }

        // where to go after order has been added
        header('location: ' . URL . 'orders/index');
    }

    /**
     * ACTION: deleteOrder
     * This method handles what happens when you move to http://palletpluscafe/orders/deleteorder
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a order" button on orders/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to orders/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $order_id Id of the to-delete order
     */
    public function deleteOrder($order_id)
    {
        Helper::authenticate();
        Helper::authorize("orders/deleteOrder");
        // if we have an id of a order that should be deleted
        if (isset($order_id)) {
            // do deleteOrder() in model/model.php
            $this->model->deleteOrder($order_id);
        }

        // where to go after order has been deleted
        header('location: ' . URL . 'orders/index');
    }

     /**
     * ACTION: editOrder
     * This method handles what happens when you move to http://palletpluscafe/orders/editorder
     * @param int $order_id Id of the to-edit order
     */
    public function editOrder($order_id)
    {
        Helper::authenticate();
        Helper::authorize("orders/editOrder");
        // if we have an id of a order that should be edited
        if (isset($order_id)) {
            // do getOrder() in model/model.php
            $order = $this->model->getOrder($order_id);
            $tables = $this->model->getAllTables();
            $menus = $this->model->getAllMenus();

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $order easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/orders/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to orders index page (as we don't have a order_id)
            header('location: ' . URL . 'orders/index');
        }
    }
    
    /**
     * ACTION: updateOrder
     * This method handles what happens when you move to http://palletpluscafe/orders/updateorder
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a order" form on orders/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to orders/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateOrder()
    {
        Helper::authenticate();
        Helper::authorize("orders/updateOrder");
        // if we have POST data to create a new order entry
        if (isset($_POST["submit_update_order"])) {
            // do updateOrder() from model/model.php
            $this->model->updateOrder(
                $_POST['order_id'],
                $_POST['tableId'],
                $_POST["menuId"],
                $_POST["status"],
                $_POST["paid"],
                $_POST["cash"], 
                $_POST["archived"]
            );
        }

        // where to go after order has been added
        header('location: ' . URL . 'orders/index');
    }

    public function placeOrder()
    {
        Helper::authenticate();
        Helper::authorize("orders/placeOrder");

        // if we have POST data to calculate all orders entry
        if (isset($_POST["submit_place_order"])) {
            $_SESSION["ordersAdd"] = $_POST["ordersAdd"];
            $temp = $_POST["ordersAdd"];
            $tableId = $_POST["ordersTableId"];
            $tableDescription = $_POST["ordersTableDescription"];
            $orders = json_decode($_POST["ordersAdd"]);
        }

        if(!is_null($orders)){
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/navigation.php';
            require APP . 'view/_templates/sidebar.php';
            require APP . 'view/orders/placeOrder.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header('location: ' . URL . 'menus/customerIndex');
        }
    }

    public function confirmOrders()
    {
        Helper::authenticate();
        Helper::authorize("orders/confirmOrders");

        // if we have POST data to create a new order entry
        if (isset($_POST["submit_confirm_orders"])) {
            // do updateOrder() from model/model.php
            $orders = json_decode($_POST['confirmOrders']);
            $maxId = $this->model->getMaxOrderId();
            $this->model->confirmOrders(
                $_POST['confirmTableId'],
                $orders,
                $maxId
            );
        }

        // where to go after order has been added
       header('location: ' . URL . 'orders/index');
    }

    public function ordersToComplete()
    {
        Helper::authenticate();
        Helper::authorize("orders/ordersToComplete");

        // if we have POST data to create a new order entry
        if (isset($_POST["submit_orders_to_complete"])) {
            // do updateOrder() from model/model.php
            $orders = $this->model->getOrdersToComplete(
                $_POST['tableId']
            );
            $tableId = $_POST['tableId'];
        }
   
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/orders/ordersToComplete.php';
        require APP . 'view/_templates/footer.php';
   
    }

    public function saveComplete()
    {
        Helper::authenticate();
        Helper::authorize("orders/saveComplete");
        
        // if we have POST data to create a new order entry
        if (isset($_POST["submit_save_complete"])) {
            // do updateOrder() from model/model.php
            $ordersForPayment = $this->model->getOrdersForPayment(
                $_POST['tableId']
            );
            $this->model->saveComplete(
                $ordersForPayment
            );
        }
   
        // where to go after order has been added
        header('location: ' . URL . 'orders/index');   
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        Helper::authenticate();
        $amount_of_orders = $this->model->getAmountOfOrders();
        echo $amount_of_orders;
    }

    public function ajaxGetNewPendingOrders(){
        Helper::authenticate();
        $orders_count = $this->model->getNewPendingOrders();
        echo '"'. $orders_count . '"';
    }

    public function ajaxGetNewReadyOrders(){
        Helper::authenticate();
        $orders_count = $this->model->getNewReadyOrders();
        echo '"'. $orders_count . '"';
    }

    public function ajaxGetNewPaymentOrders(){
        Helper::authenticate();
        $orders_count = $this->model->getNewPaymentOrders();
        echo '"'. $orders_count . '"';
    }

    public function ajaxUpdateOrderStatus(){
        Helper::authenticate();
        echo($_POST["status"]);
        if($_POST["status"] == OrderStatus::processing){
            $continue = $this->model->updateIngredientsInventory($_POST["id"]);
        }
        else{
            $continue = true;
        }
        if($continue){
            $this->model->updateOrderStatus($_POST["id"], $_POST["status"]);
        }
    }

}
