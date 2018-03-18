<div class="customer-index">
    <div class="menu-list">
        <div class="menu-list-header">    
            <div class="menu-logo"><img src="<?php echo URL; ?>img/logo.png"></div>
            <div class="menu-category"> My Orders </div>
        </div>
        <!-- main content output -->
        <div class="my-orders-content">
            <div class="table-name">Table Alpha</div>
            <table>
                <thead>
                <tr>
                    <td></td>
                    <td>Menu Item</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Amount</td>
                </tr>
                </thead>
                <tbody>
                <?php $grandTotal = 0; foreach ($orders as $order) { ?>
                    <tr>
                        <td class="order-photo"><img src="<?php echo URL; ?>img/bf1.jpg"></td>
                        <td class="order-menuName"><?php if (isset($order->menuName)) echo htmlspecialchars($order->menuName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="order-price">Php <?php if (isset($order->price)) echo htmlspecialchars($order->price, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="order-quantity"><?php if (isset($order->quantity)) echo htmlspecialchars($order->quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="order-priceTotal"><?php if (isset($order->priceTotal)) echo htmlspecialchars($order->priceTotal, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>    
                <?php $grandTotal += $order->priceTotal; } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="total">Total</td>
                    <td class="total">Php <?php echo $grandTotal; ?></td>
                </tr>
                </tbody>
            </table>
        </div>        
        <div class="menu-add-order">
            <div class ="row cancel-confirm">
                <form action="<?php echo URL; ?>orders/saveComplete" method="POST">
                <input type="hidden" id="tableId" name="tableId" value='<?php echo $tableId; ?>' />
                <button class="complete-orders" type="submit" name="submit_save_complete"><i class="fas fa-plus-circle display-icon"></i>Pay Orders</button>
                </form>
            </div>
        </div>
    </div>
</div>
