<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-shopping-bag display-icon"></i>Edit Menu Ingredient Item</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>menuIngredient/updatemenuingredient" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Menu Name</label></div>
                                <div>
                                    <select id="menuId" name="menuId" value="" required>
                                    <option value=""></option>
                                    <?php foreach ($menus as $menu) { ?>
                                        <option 
                                            value="<?php if (isset($menu->id)) echo htmlspecialchars($menu->id, ENT_QUOTES, 'UTF-8'); ?>"
                                            <?php if ($menu->id ==  $menuIngredient->menuId) echo 'selected';?>
                                        >
                                        <?php if (isset($menu->menuName)) echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Ingredient</label></div>
                                <div>
                                    <select id="ingredientId" name="ingredientId" value="" required>
                                    <option value=""></option>
                                    <?php foreach ($ingredients as $ingredient) { ?>
                                        <option 
                                            value="<?php if (isset($ingredient->id)) echo htmlspecialchars($ingredient->id, ENT_QUOTES, 'UTF-8'); ?>"
                                            <?php if ($ingredient->id ==  $menuIngredient->ingredientId) echo 'selected';?>
                                        >
                                        <?php if (isset($ingredient->name)) echo htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Amount</label></div>
                                <div><input type="number" name="amount" value="<?php if (isset($menuIngredient->amount)) echo htmlspecialchars($menuIngredient->amount, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Unit</label></div>
                                <div><label ><?php if (isset($menuIngredient->unit)) echo htmlspecialchars($menuIngredient->unit, ENT_QUOTES, 'UTF-8'); ?></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="" required>
                                        <option value="0" <?php if ($menuIngredient->archived == "0") echo 'selected';?>>False</option>
                                        <option value="1" <?php if ($menuIngredient->archived == "1") echo 'selected';?>>True</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <input type="hidden" name="menuIngredient_id" value="<?php echo htmlspecialchars($menuIngredient->id, ENT_QUOTES, 'UTF-8'); ?>" />
                                <button class="primary-button" type="submit" name="submit_update_menuIngredient" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>