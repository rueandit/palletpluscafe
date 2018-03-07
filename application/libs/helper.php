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
                    if ($type == UserType::waiter || $type == UserType::cashier || $type == UserType::kitchen){
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

    ///TO DO: notification module - ajax call, study tables involved
    ///user order different than admin order
    ///update permission for all screens added
    ///order view of kitchen
    static public function showNotificationIcon(){
        if(isset($_SESSION['user_type'])) {
            if($_SESSION['user_type'] == UserType::waiter || $_SESSION['user_type'] == UserType::kitchen){
                echo '<div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                            <ul class="dropdown-menu"></ul>
                        </div>';
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