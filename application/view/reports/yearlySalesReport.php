<?php
    $dataPoints = array();
?>
<div class="menu-container">
        <div class="list-header">    
        <div class="title"><i class="fas fa-shopping-bag display-icon"></i>Annual Sales Report</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_tables" ><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_tables" ><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="filters" id="filters">
            <div class="filter-header">
                <div class="title filter-title">Filters </div>
            </div>
            <form action="<?php echo URL; ?>reports/yearlySalesReport" method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filter-row" >
                            <label class="report-filter">Start Date</label><input format="yyyy-mm-dd" class="report-filter" type="date" name="startDate" value="<?php echo $_SESSION['startDate']; ?>" required/>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-4 filter-row">
                            <button class="primary-button report-filter-submit" type="submit" name="submit_sales_report" ><i class="fas fa-check display-icon"></i>Submit</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
        <!-- main content output -->
        <div class="chart-container"><div class="charts" id="chartContainer"></div></div>
        <div class="list-content">
        <table class="reports">
            <thead>
            <tr>
                <td></td>
                <td class="strings">Menu Name</td>
                <td class="td-small">Price</td>
                <td class="td-small">Quantity</td>
                <td>Total</td>
            </tr>
            </thead>
            <tbody>
            <?php 
                $monthlyTotal = 0;
                $grandTotal = 0;
                $month = "";
                
                foreach ($sales as $sale) {

                    $year = $sale->yearOrdered; 
                    $grandTotal = $grandTotal + $sale->priceTotal;
                    $monthlyTotal = $monthlyTotal + $sale->priceTotal;
                    
                    if ($sale->monthOrdered != $month){
                        echo('<tr class=" heading"><td class="dayOfWeek">'.$sale->monthOrdered.'</td><td colspan="5"></td></tr>');
                        $month = $sale->monthOrdered;
                        $newData = array("y" => $monthlyTotal, "label" => $month);
                        array_push($dataPoints, $newData);

                        $monthlyTotal = 0;
                    }
                ?>
                <tr>
                    <td></td>
                    <td class="strings"><?php if (isset($sale->menuName)) echo htmlspecialchars($sale->menuName, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small numbers">Php <?php if (isset($sale->price)) echo htmlspecialchars($sale->price, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small numbers"><?php if (isset($sale->quantity)) echo htmlspecialchars($sale->quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td >Php <?php if (isset($sale->priceTotal)) echo htmlspecialchars($sale->priceTotal, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php 
                } ?>
            <tr class="sales-total heading">
                <td></td>
                <td class="td-small"></td>
                <td class="td-small"></td>
                <td>Annual Sales Total</td>
                <td>Php  <?php echo $grandTotal; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    window.onload = function () {
 
    var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: <?php echo '"Sales Over the Year of '.$year.'"'; ?>
        },
        axisY: {
            title: "Amount"
        },
        data: [{
            type: "line",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    }
</script>
