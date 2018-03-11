<div class="menu-container">
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
                <?php foreach ($myOrders as $myOrder) { ?>
                    <tr>
                        <td class="order-photo"><img src="<?php echo URL; ?>img/bf1.jpg"></td>
                        <td class="order-menuName"><?php if (isset($myOrder->menuName)) echo htmlspecialchars($myOrder->menuName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="order-price">Php <?php if (isset($myOrder->price)) echo htmlspecialchars($myOrder->price, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="order-quantity"><?php if (isset($myOrder->quantity)) echo htmlspecialchars($myOrder->quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="order-priceTotal"><?php if (isset($myOrder->priceTotal)) echo htmlspecialchars($myOrder->priceTotal, ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>    
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="total">Total</td>
                    <td class="total">Php 1233</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
