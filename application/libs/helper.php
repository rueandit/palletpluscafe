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
    
    ///TO DO: refactor:
    ///         move to a separate class if necessary
    ///         evaluate the need for creating enum or storing permissions to DB
    ///         validation is at page level, buttons to initialize functionality will still show (i.e. add button)
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
}