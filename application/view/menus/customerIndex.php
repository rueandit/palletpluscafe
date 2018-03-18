<div class="customer-index">
    <div class="menu-list">
        <div class="menu-list-header">    
            <div class="menu-logo"><img src="<?php echo URL; ?>img/logo.png"></div>
            <div class="menu-category"> Customer Menu </div>
        </div>
        <div class="menu-filter">
            <form action="<?php echo URL; ?>menus/customerIndex" method="POST">      
            <input type="hidden" id="orders" name="orders" value='<?php echo $_SESSION["orders"]; ?>' />
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
                        <div class="filter-fields">
                            <div class="filter-details">
                                <div class="input-label">Orders for table: </div>
                                <div class="input-list">
                                    <select id="tableId" name="tableId" value="" class = "input-item input-list" required>
                                        <option value=""></option>
                                        <?php foreach ($tables as $table) { ?>
                                            <option value="<?php if (isset($table->id)) echo htmlspecialchars($table->id, ENT_QUOTES, 'UTF-8'); ?>"
                                            <?php if ($_SESSION["tableId"] == $table->id) echo 'selected';?>>
                                            <?php if (isset($table->description)) echo htmlspecialchars($table->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
                        <div class="filter-fields">
                            <div class="filter-details">
                                <button class="primary-button input-label" type="submit" name="submit_search_category"><i class="fas fa-filter display-icon"></i>By Category</button>
                                <select id="category" name="category" value="" class = "input-item input-list">
                                <option value=""></option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php if (isset($category->id)) echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php if ($categoryId == $category->id) echo 'selected';?>>
                                    <?php if (isset($category->description)) echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row filter-buttons">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 no-padding" >
                                <button class="btn-best fullwidth " type="submit" name="submit_search_best">
                                    <div class="menu-filter-icon icon-best"></div>
                                    <div class="filter-label">Best Seller</div>
                                </button>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 no-padding" >
                                <button class="btn-low  fullwidth" type="submit" name="submit_search_low">
                                    <div class="menu-filter-icon icon-low"></div>
                                    <div class="filter-label">Lowest</div>
                                </button>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 no-padding" >
                                <button class="btn-high  fullwidth" type="submit" name="submit_search_high">
                                    <div class="menu-filter-icon icon-high"></div>
                                    <div class="filter-label"> Highest</div>
                                </button>
                            </div>
                 </div>   
            </form>
        </div>        
        <!-- main content output -->
        <div class="menu-list-content">
            <div class ="row">
            <?php foreach ($menus as $menu) {
                $quantity = 0; 
                if(isset($currentSelection)){
                    $menuId = $menu->id;
                    $selection = array_filter(
                        $currentSelection, 
                        function ($e) use ($menuId){ 
                            return $e->menuId == $menuId;
                    });
                    $matched = current((Array)$selection);
                    if(isset($matched->quantity)) { $quantity = $matched->quantity; }
                }
                ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 input-item">
                    <div class="menu-tile">
                        <div class="menu-details">
                            <div class="menu-photo"><img src="<?php if($menu->imageFileName == "") {$filename = "no-image.png";} else {$filename = $menu->imageFileName;} echo URL . "img/" . $filename; ?>" class="menu-photo"/></div>
                            <div class="menu-text">
                                <input type="hidden" id="<?php echo 'menu-name-'.$menu->id?>" class="menuName" value="<?php echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?>" />
                                <input type="hidden"  id="<?php echo 'menu-price-'.$menu->id?>" class="menuPrice" value="<?php echo htmlspecialchars($menu->price, ENT_QUOTES, 'UTF-8'); ?>" />
                                <div class="menu-name"><?php if (isset($menu->menuName)) echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-price">Php <?php if (isset($menu->price)) echo htmlspecialchars($menu->price, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-description"><?php if (isset($menu->menuDescription)) echo htmlspecialchars($menu->menuDescription, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-allergen"><b>Allergen:</b><?php if (isset($menu->allergen)) echo htmlspecialchars($menu->allergen, ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="menu-actions">
                                    <button id="<?php echo 'decrease-'.$menu->id?>" class="decrease"><i class="fas fa-minus" onClick=></i></button>
                                    <div class="counter"><input id="<?php echo 'counter-'.$menu->id ?>" type="text" name="counter" value="<?php echo $quantity; ?>"/></div>
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
    <div class="menu-add-order">
        <div class ="row cancel-confirm">
            <form action="<?php echo URL; ?>menus/customerIndex" method="POST">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                    <button id="btn-cancel-order" class="cancel-orders"><i class="fas fa-times display-icon"></i>Clear Selections</button>
                </div>
            </form>
            <form action="<?php echo URL; ?>orders/placeOrder" method="POST">
                <input type="hidden" id="ordersAdd" name="ordersAdd" value='<?php echo ($_SESSION["orders"])?>' />
                <input type="hidden" id="ordersTableId" name="ordersTableId" value='<?php echo ($_SESSION["tableId"])?>' />
                <input type="hidden" id="ordersTableDescription" name="ordersTableDescription" value='<?php echo ($_SESSION["tableDescription"])?>' />
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                    <button id="btn-place-order" class="add-orders" type="submit" name="submit_place_order"><i class="fas fa-plus display-icon"></i>Place My Orders</button>
                </div>
            </form>
        </div>
    </div>
</div>
