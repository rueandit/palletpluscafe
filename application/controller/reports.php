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
class Reports extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://palletpluscafe/orders/index
     */
    public function inventoryReport()
    {
        Helper::authenticate();
        Helper::authorize("reports/inventoryReport");

        $ingredients = $this->model->getAllIngredients();

       // load views. within the views we can echo out $orders and $amount_of_orders easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/reports/inventoryReport.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function dailySalesReport()
    {
        Helper::authenticate();
        Helper::authorize("reports/dailySalesReport");

        $_SESSION['startDate'] = date("Y/m/d");
        $startDate = '"'.date("Y/m/d").'"';

        if (isset($_POST["submit_sales_report"])) {
            $_SESSION['startDate'] = $_POST["startDate"];
            $startDate = '"'.$_POST["startDate"].'"';  
        }

        $sales = $this->model->getDailySalesReport($startDate);

       // load views. within the views we can echo out $orders and $amount_of_orders easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/reports/dailySalesReport.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }


    public function weeklySalesReport()
    {
        Helper::authenticate();
        Helper::authorize("reports/weeklySalesReport");

        $_SESSION['startDate'] = date("Y/m/d");
        $startDate = '"'.date("Y/m/d").'"';

        if (isset($_POST["submit_sales_report"])) {
            $_SESSION['startDate'] = $_POST["startDate"];
            $startDate = '"'.$_POST["startDate"].'"';  
        }
    
        $sales = $this->model->getWeeklySalesReport($startDate);

    // load views. within the views we can echo out $orders and $amount_of_orders easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/reports/weeklySalesReport.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function monthlySalesReport()
    {
        Helper::authenticate();
        Helper::authorize("reports/monthlySalesReport");

        $_SESSION['startDate'] = date("Y/m/d");
        $startDate = '"'.date("Y/m/d").'"';

        if (isset($_POST["submit_sales_report"])) {
            $_SESSION['startDate'] = $_POST["startDate"];
            $startDate = '"'.$_POST["startDate"].'"';  
        }

        $sales = $this->model->getMonthlySalesReport($startDate);

       // load views. within the views we can echo out $orders and $amount_of_orders easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/reports/monthlySalesReport.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }
    public function yearlySalesReport()
    {
        Helper::authenticate();
        Helper::authorize("reports/yearlySalesReport");

        $_SESSION['startDate'] = date("Y/m/d");
        $startDate = '"'.date("Y/m/d").'"';

        if (isset($_POST["submit_sales_report"])) {
            $_SESSION['startDate'] = $_POST["startDate"];
            $startDate = '"'.$_POST["startDate"].'"';  
        }

        $sales = $this->model->getYearlySalesReport($startDate);

       // load views. within the views we can echo out $orders and $amount_of_orders easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/reports/yearlySalesReport.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }
}
