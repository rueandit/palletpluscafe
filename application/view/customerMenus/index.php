<div class="menu-container">
    <div class="menu-list">
        <div class="menu-list-header">    
            <div class="menu-logo"><img src="<?php echo URL; ?>img/logo.png"></div>
            <div class="menu-category"> Breakfast </div>
        </div>
        <div class="menu-add-order"><button id="addOrder" class="add-orders"><i class="fas fa-plus display-icon"></i>Add to Orders</button></div>
        <!-- main content output -->
        <div class="menu-list-content">
            <div class ="row">
            <?php foreach ($menus as $menu) { ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 input-item">
                    <div class="menu-tile">
                        <div class="menu-details">
                            <div class="menu-photo"><img src="<?php echo URL; ?>img/bf1.jpg"></div>
                            <div class="menu-text">
                                <div class="menu-name"><?php if (isset($menu->menuName)) echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-price">Php <?php if (isset($menu->price)) echo htmlspecialchars($menu->price, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-description"><?php if (isset($menu->menuDescription)) echo htmlspecialchars($menu->menuDescription, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-allergen"><b>Allergen:</b><?php if (isset($menu->allergen)) echo htmlspecialchars($menu->allergen, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-actions">
                                    <button id="<?php echo 'decrease-'.$menu->id?>" class="decrease"><i class="fas fa-minus" onClick=></i></button>
                                    <div class="counter"><input id="<?php echo 'counter-'.$menu->id ?>" type="text" name="counter" value="0"/></div>
                                    <button id="<?php echo 'increase-'.$menu->id ?>"  class="increase"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>      
            <?php } ?>
            </div>
        </div>
    </div>
</div>
