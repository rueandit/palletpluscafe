<div class="menu-container">
        <div class="list-header">
            <div class="title"><i class="fas fa-clipboard-list display-icon"></i>Cashier Order List</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_orders"><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_orders"><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="filters" id="filters">
            <div class="filter-header">
                <div class="title filter-title">Filters </div>
            </div>
            <form action="<?php echo URL; ?>orders/index" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                        <div><label >Table Name</label></div>
                        <div>
                            <select id="tableId" name="tableId" value="">
                            <option value=""></option>
                            <?php foreach ($tables as $table) { ?>
                                <option 
                                    value="<?php if (isset($table->id)) echo htmlspecialchars($table->id, ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php if ($table->id ==  $tableId) echo 'selected';?>
                                >
                                <?php if (isset($table->description)) echo htmlspecialchars($table->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item" >
                        <div><label >Order</label></div>
                        <div><input type="text" name="menuName" value="<?php echo $menuName;?>" /></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                        <div><label>Status</label></div>
                        <div>
                            <select id="status" name="status" value="">
                            <option value=""></option>
                            <?php foreach (OrderStatus::getList() as $statusItem) { ?>
                                <option value="<?php echo $statusItem ?>" <?php if ($statusItem == $status) echo 'selected';?>>
                                <?php echo $statusItem; }?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                        <div><label >Received Date</label></div>
                        <div><input  class="report-filter" type="date" name="createdDate" value="<?php echo $createdDate; ?>"</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                        <button class="primary-button" type="submit" name="submit_limited_search_order" ><i class="fas fa-check display-icon"></i>Submit</button>
                    </div>
                </div>
            </div> 
            </form>
            </div>
        </div>
        <!-- main content output -->
        <div class="list-content" id="orders">
            <table>
                <thead>
                <tr>
                    <td>Table</td>
                    <td>Order</td>
                    <td class="td-small">Status</td>
                    <td class="td-medium">Received Date</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>
                    <form action="<?php echo URL; ?>orders/ordersToComplete" method="POST">
                        <td>
                            <input type="hidden" id="tableId" name="tableId" value='<?php if (isset($order->tableId)) echo htmlspecialchars($order->tableId, ENT_QUOTES, 'UTF-8'); ?>' />
                            <?php if (isset($order->tableName)) echo htmlspecialchars($order->tableName, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td ><?php if (isset($order->menuName)) echo htmlspecialchars($order->menuName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="td-small"><?php if (isset($order->status)) echo htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="td-medium"><?php if (isset($order->createdDate)) echo htmlspecialchars($order->createdDate, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="col-lg-2">
                            <?php
                            ///TO DO: hook up with the POS
                            if($order->status == OrderStatus::forPayment){
                                echo '<button class="btn-success btn-block" type="submit"  name="submit_orders_to_complete"><i class="fa fa-check"></i> Complete</button>';
                            }
                            ?>
                        </td>
                    </form>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
