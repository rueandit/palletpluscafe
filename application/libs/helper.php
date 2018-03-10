<?php

class Helper
{
    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     * 
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                if (substr($key, 1,2) == 'nq'){
                    $values[$key] = $value ;
                }else{
                    $values[$key] = "'" . $value . "'";
                }
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        
        echo "<br> [DEBUG] Keys:<pre>";
        print_r($keys);
        
        echo "\n[DEBUG] Values: ";
        print_r($values);
        echo "</pre>";
        
    
        $raw_sql = preg_replace($keys, $values, $raw_sql, 2, $count);

        return $raw_sql;
    }

    ///TO DO: refactor this to be called once - move to core/application.php
    static public function authenticate(){
        if(!isset($_SESSION['username'])) {
            header('location: ' . URL. 'problem');
            die();
        }
    }
    
    ///TO DO
    /// refactor:
    ///         move to a separate class if necessary
    ///         evaluate the need for creating enum or storing permissions to DB
    ///         validation is at page level, buttons to initialize functionality will still show (i.e. add button)
    ///         instead of passing pages, pass who has access??
    // Super Admin -> user creation, logs
    // Admin -> Menus, Orders, Ingredients, Tables, Allergens, Categories, Reports
    // Waiter,Cashier -> Menus(View Only), Orders (note: would differ on notif)
    // Kitchen -> Orders, Inventory status (based on ingredients)
    static public function authorize($page){
        $isAuthorized = true;
        
        if(!isset($_SESSION['user_type'])) {
            $isAuthorized = false;
        }
        else{
            $type = $_SESSION['user_type'];
            switch($page){
                case "menus/index" :
                    if ($type == UserType::kitchen){
                        $isAuthorized = false;
                    }
                    break;
                case "menus/addMenu" :
                case "menus/submitMenu" :
                case "menus/deleteMenu" :
                case "menus/editMenu" :
                case "menus/updateMenu" :
                case "allergens/index" :
                case "allergens/addAllergen" :
                case "allergens/submitAllergen" :
                case "allergens/deleteAllergen" :
                case "allergens/editAllergen" :
                case "allergens/updateAllergen" :
                case "categories/index" :
                case "categories/addCategory" :
                case "categories/submitCategory" :
                case "categories/deleteCategory" :
                case "categories/editCategory" :
                case "categories/updateCategory" :
                case "ingredients/index" :
                case "ingredients/addIngredient" :
                case "ingredients/submitIngredient" :
                case "ingredients/deleteIngredient" :
                case "ingredients/editIngredient" :
                case "ingredients/updateIngredient" :
                case "tables/index" :
                case "tables/addTable" :
                case "tables/submitTable" :
                case "tables/deleteTable" :
                case "tables/editTable" :
                case "tables/updateTable" :
                case "menuIngredients/index" :
                case "menuIngredients/addMenuIngredient" :
                case "menuIngredients/submitMenuIngredient" :
                case "menuIngredients/deleteMenuIngredient" :
                case "menuIngredients/editMenuIngredient" :
                case "menuIngredients/updateMenuIngredient" :
                    if ($type == UserType::waiter || $type == UserType::cashier || $type == UserType::kitchen){
                        $isAuthorized = false;
                    }
                    break;
                case "users/index" :
                case "users/addUser" :
                case "users/submitUser" :
                case "users/deleteUser" :
                case "users/editUser" :
                case "users/updateUser" :
                    if ($type == UserType::waiter || $type == UserType::cashier || $type == UserType::kitchen || $type == UserType::admin){
                        $isAuthorized = false;
                    }
                    break;
            }
        }

        if (!$isAuthorized){
            header('location: ' . URL . 'problem');
            die();
        }
    }

    ///TO DO: 
    ///user order different than admin order
    ///modify ui/ux of toastr
    ///make status enum
    ///reload table
    static public function enableNotification(){
        if(isset($_SESSION['user_type'])) {
            if($_SESSION['user_type'] == UserType::waiter || $_SESSION['user_type'] == UserType::kitchen || $_SESSION['user_type'] == UserType::cashier){
                echo 'setInterval(function(){
                    debugger;
                    if($("#orders").length > 0){
                        notifyIncomingOrders();
                    }
                }, 10000);';
            }
        }
    }

    static public function sideBarListAuth(){
        if(isset($_SESSION['user_type'])) {
            switch($_SESSION['user_type']){
                case UserType::superAdmin:
                    echo '<a href="'. URL . 'users"><i class="fas fa-users display-icon"></i> User Accounts</a>
                    <a href="'. URL . 'menus"><i class="fas fa-utensils display-icon"></i> Menu</a>
                    <a href="'. URL . 'tables"><i class="fas fa-hockey-puck display-icon"></i> Tables</a>
                    <a href="'. URL . 'orders"><i class="fas fa-clipboard-list display-icon"></i> Orders</a>
                    <a href="'. URL . 'ingredients"><i class="fas fa-shopping-bag display-icon"></i> Ingredients</a>
                    <a href="'. URL . 'allergens"><i class="fas fa-syringe display-icon"></i> Allergens</a>
                    <a href="'. URL . 'categories"><i class="fas fa-tags display-icon"></i> Categories</a>
                    <a href="'. URL . 'menuIngredient"><i class="fas fa-shopping-bag display-icon"></i> Menu Ingredients</a>
                    <a href="'. URL . 'reports"><i class="fas fa-chart-bar display-icon"></i> Reports</a>';
                    break;
                case UserType::admin:
                    echo '<a href="'. URL . 'menus"><i class="fas fa-utensils display-icon"></i> Menu</a>
                    <a href="'. URL . 'tables"><i class="fas fa-hockey-puck display-icon"></i> Tables</a>
                    <a href="'. URL . 'orders"><i class="fas fa-clipboard-list display-icon"></i> Orders</a>
                    <a href="'. URL . 'ingredients"><i class="fas fa-shopping-bag display-icon"></i> Ingredients</a>
                    <a href="'. URL . 'allergens"><i class="fas fa-syringe display-icon"></i> Allergens</a>
                    <a href="'. URL . 'categories"><i class="fas fa-tags display-icon"></i> Categories</a>
                    <a href="'. URL . 'menuIngredient"><i class="fas fa-shopping-bag display-icon"></i> Menu Ingredients</a>
                    <a href="'. URL . 'reports"><i class="fas fa-chart-bar display-icon"></i> Reports</a>';
                    break;
                case UserType::waiter:
                case UserType::cashier:
                    echo '<a href="'. URL . 'menus"><i class="fas fa-utensils display-icon"></i> Menu</a>
                    <a href="'. URL . 'orders"><i class="fas fa-clipboard-list display-icon"></i> Orders</a>';
                    break;
                case UserType::kitchen:
                    echo '<a href="'. URL . 'orders"><i class="fas fa-clipboard-list display-icon"></i> Orders</a>
                    <a href="'. URL . 'ingredients"><i class="fas fa-shopping-bag display-icon"></i> Ingredients</a>
                    <a href="'. URL . 'menuIngredient"><i class="fas fa-shopping-bag display-icon"></i> Menu Ingredients</a>';
                    break;
                default:
                    echo 'No Access';
                    break;
            }
        }
    }
    static public function getLandingPage(){
        switch ($_SESSION["user_type"]){
            case UserType::superAdmin:
            case UserType::admin:
            case UserType::waiter:
            case UserType::cashier:
                return 'menus';
                break;
            case UserType::kitchen:
                return 'orders';
                break;
            default:
                return 'problems';
                break;
        }
        return 'problems';
    }
}