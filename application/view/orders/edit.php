<div class="menu-container">
    <div class="list-header">    
        <div class="title">Edit Order Item</div>
    </div>
    <div class="add-edit" id="add-edit">
        <div class="container">
            <form action="<?php echo URL; ?>orders/updateorder" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label >Table Name</label></div>
                        <div>
                            <select id="tableId" name="tableId" value="">
                            <option value=""></option>
                            <?php foreach ($tables as $table) { ?>
                                <option 
                                    value="<?php if (isset($table->id)) echo htmlspecialchars($table->id, ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php if ($table->id ==  $order->tableId) echo 'selected';?>
                                >
                                <?php if (isset($table->description)) echo htmlspecialchars($table->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                        <div><label >Menu Item</label></div>
                        <div>
                            <select id="menuId" name="menuId" value="">
                            <option value=""></option>
                            <?php foreach ($menus as $menu) { ?>
                                <option 
                                    value="<?php if (isset($menu->id)) echo htmlspecialchars($menu->id, ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php if ($menu->id ==  $order->menuId) echo 'selected';?>
                                >
                                <?php if (isset($menu->menuName)) echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label>Status</label></div>
                        <div>
                            <select id="status" name="status" value="">
                            <option value=""></option>
                            <?php foreach (OrderStatus::getList() as $status) { ?>
                                <option value="<?php echo $status;?>" <?php if (strtolower(rtrim(ltrim($order->status))) == strtolower(rtrim(ltrim($status)))) {echo 'selected';} ?>>
                                <?php echo $status; }?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label >Paid</label></div>
                        <div>
                            <select id="paid" name="paid" value="">
                                <option value="0" <?php if ($order->paid == "0") echo 'selected';?>>False</option>
                                <option value="1" <?php if ($order->paid == "1") echo 'selected';?>>True</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label >Cash</label></div>
                        <div>
                            <select id="cash" name="cash" value="">
                                <option value="0" <?php if ($order->cash == "0") echo 'selected';?>>False</option>
                                <option value="1" <?php if ($order->cash == "1") echo 'selected';?>>True</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label>Archived</label></div>
                        <div>
                            <select id="archived" name="archived" value="">
                                <option value="0" <?php if ($order->archived == "0") echo 'selected';?>>False</option>
                                <option value="1" <?php if ($order->archived == "1") echo 'selected';?>>True</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order->id, ENT_QUOTES, 'UTF-8'); ?>" />
                        <button class="primary-button" type="submit" name="submit_update_order" ><i class="fas fa-check display-icon"></i>Submit</button>
                    </div>
                </div>
            </div>    
        </form>
    </div>
</div>