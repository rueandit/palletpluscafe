<div class="menu-container">
        <div class="list-header">
            <div class="title"><i class="fas fa-clipboard-list display-icon"></i>Order List</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_orders"><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_orders"><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                    <div class="add">
                        <form action="<?php echo URL; ?>orders/addOrder" method="POST">
                            <button class="primary-button" type="submit" name="submit_add_order"><i class="fas fa-plus-circle display-icon"></i>Add</button>
                        </form> 
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
                            <div><label >Menu Item</label></div>
                            <div><input type="text" name="menuName" value="<?php echo $menuName;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Status</label></div>
                            <div><input type="text" name="status" value="<?php echo $status;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Paid</label></div>
                            <div>
                                <select id="paid" name="paid" value="">
                                    <option value=""></option>
                                    <option value="0" <?php if ($paid == "0") echo 'selected';?>>False</option>
                                    <option value="1" <?php if ($paid == "1") echo 'selected';?>>True</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Cash</label></div>
                            <div>
                                <select id="cash" name="cash" value="">
                                    <option value=""></option>
                                    <option value="0" <?php if ($cash == "0") echo 'selected';?>>False</option>
                                    <option value="1" <?php if ($cash == "1") echo 'selected';?>>True</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Created Date</label></div>
                            <div><input type="text" name="createdDate" value="<?php echo $createdDate;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Modified Date</label></div>
                            <div><input type="text" name="modifiedDate" value="<?php echo $modifiedDate;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Modified by</label></div>
                            <div>
                                <select id="modifiedBy" name="modifiedBy" value="">
                                <option value=""></option>
                                <?php foreach ($users as $user) { ?>
                                    <option 
                                        value="<?php if (isset($user->id)) echo htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?>"
                                        <?php if ($user->id ==  $modifiedBy) echo 'selected';?>
                                    >
                                    <?php if (isset($user->username)) echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                            <div><label>Archived</label></div>
                            <div>
                                <select id="archived" name="archived" value="">
                                    <option value=""></option>
                                    <option value="0" <?php if ($archived == "0") echo 'selected';?>>False</option>
                                    <option value="1" <?php if ($archived == "1") echo 'selected';?>>True</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                            <button class="primary-button" type="submit" name="submit_search_order" ><i class="fas fa-check display-icon"></i>Submit</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
        <!-- main content output -->
    
        <div class="list-content">
        <table>
            <thead>
            <tr>
                <td>Table</td>
                <td>Menu Item</td>
                <td class="td-small">Status</td>
                <td class="td-small">Paid</td>
                <td class="td-medium">Cash</td>
                <td class="td-small">Created Date</td>
                <td class="td-medium">Modified Date</td>
                <td class="td-medium">Modified By</td>
                <td class="td-medium">Archived</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?php if (isset($order->tableName)) echo htmlspecialchars($order->tableName, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td ><?php if (isset($order->menuName)) echo htmlspecialchars($order->menuName, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($order->status)) echo htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($order->paid)) echo htmlspecialchars($order->paid, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-medium"><?php if (isset($order->cash)) echo htmlspecialchars($order->cash, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($order->createdDate)) echo htmlspecialchars($order->createdDate, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-medium"><?php if (isset($order->modifiedDate)) echo htmlspecialchars($order->modifiedDate, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-medium"><?php if (isset($order->modifiedBy)) echo htmlspecialchars($order->modifiedBy, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-medium"><?php if (isset($order->archived)) echo htmlspecialchars($order->archived, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="list-action" href="<?php echo URL . 'orders/editorder/' . htmlspecialchars($order->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-edit display-icon"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
