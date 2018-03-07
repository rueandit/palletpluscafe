<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-utensils display-icon"></i>Edit Menu Item</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>menus/updatemenu" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Name</label></div>
                                <div><input type="text" name="menuName" value="<?php if (isset($menu->menuName)) echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?>"  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Description</label></div>
                                <div><input type="text" name="menuDescription" value="<?php if (isset($menu->menuDescription)) echo htmlspecialchars($menu->menuDescription, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Status</label></div>
                                <div>
                                    <select id="menuStatus" name="menuStatus" value="" required>
                                        <option value="Available" <?php if ($menu->menuStatus == "Available") echo 'selected';?>>Available</option>
                                        <option value="Not Available" <?php if ($menu->menuStatus == "Not Available") echo 'selected';?>>Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Price</label></div>
                                <div><input type="text" name="price" value="<?php if (isset($menu->price)) echo htmlspecialchars($menu->price, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Rating</label></div>
                                <div>
                                    <select id="rating" name="rating" value="" required>
                                        <option value="Normal" <?php if ($menu->rating == "Normal") echo 'selected';?>>Normal</option>
                                        <option value="Recommended" <?php if ($menu->rating == "Recommended") echo 'selected';?>>Recommended</option>
                                        <option value="Best Seller" <?php if ($menu->rating == "Best Seller") echo 'selected';?>>Best Seller</option>
                                        <option value="New" <?php if ($menu->rating == "New") echo 'selected';?>>New</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="" required>
                                        <option value="0" <?php if ($menu->archived == "0") echo 'selected';?>>False</option>
                                        <option value="1" <?php if ($menu->archived == "1") echo 'selected';?>>True</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Category</label></div>
                                <div>
                                    <select id="category" name="category" value="" required>
                                    <?php foreach ($categories as $category) { ?>
                                        <option 
                                            value="<?php if (isset($category->id)) echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>"
                                            <?php if ($category->id ==  $menu->category) echo 'selected';?>
                                            ><?php if (isset($category->description)) echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Sub Category</label></div>
                                <div>
                                    <select id="subCategory" name="subCategory" value="">
                                        <option value="" <?php if ($menu->subCategory == "") echo 'selected';?>></option>
                                        <option value="Solo" <?php if ($menu->subCategory == "Solo") echo 'selected';?>>Solo</option>
                                        <option value="Regular" <?php if ($menu->subCategory == "Regular") echo 'selected';?>>Regular</option>
                                        <option value="Big" <?php if ($menu->subCategory == "Big") echo 'selected';?>>Big</option>
                                        <option value="Affagato" <?php if ($menu->subCategory == "Affagato") echo 'selected';?>>Affagato</option>
                                        <option value="Italian" <?php if ($menu->subCategory == "Italian") echo 'selected';?>>Italian</option>
                                        <option value="Small" <?php if ($menu->subCategory == "Small") echo 'selected';?>>Small</option>
                                        <option value="Medium" <?php if ($menu->subCategory == "Medium") echo 'selected';?>>Medium</option>
                                        <option value="Large" <?php if ($menu->subCategory == "Large") echo 'selected';?>>Large</option>
                                        <option value="Hot" <?php if ($menu->subCategory == "Hot") echo 'selected';?>>Hot</option>
                                        <option value="Iced" <?php if ($menu->subCategory == "Iced") echo 'selected';?>>Iced</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Allergen</label></div>
                                <div>
                                    <select id="allergen" name="allergen" value="">
                                    <?php foreach ($allergens as $allergen) { ?>
                                        <option 
                                        value="<?php if (isset($allergen->id)) echo htmlspecialchars($allergen->id, ENT_QUOTES, 'UTF-8'); ?>"
                                        <?php if ($allergen->id ==  $menu->allergen) echo 'selected';?>
                                        >
                                        <?php if (isset($allergen->description)) echo htmlspecialchars($allergen->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Photo</label></div>
                                <div><input type="text" name="imageFile" 
                                value="<?php if (isset($menu->allergen)) echo htmlspecialchars($menu->allergen, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <input type="hidden" name="menu_id" value="<?php echo htmlspecialchars($menu->id, ENT_QUOTES, 'UTF-8'); ?>" />
                                <button class="primary-button" type="submit" name="submit_update_menu" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>