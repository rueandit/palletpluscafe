<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-utensils fa-icon"></i>Menu List</div>
            <div class="primary-actions">
                    <div >
                        <div class="search-bar">
                            <form action="<?php echo URL; ?>menus" method="POST">
                                <input class="search-input" type="text" name="menuName" value="" />
                                <button class="icon-button" type="submit" name="search_menu" ><i class="fa fa-search"></i></button>
                            </form>
                            <button id="showFilter" class="icon-button" type="submit" name="search_menu" onclick="showFilter()"><i class="fa fa-filter"></i></button>
                        </div>    
                    </div>
                    <div class="add">
                        <form action="<?php echo URL; ?>menus/addMenu" method="POST">
                            <button class="primary-button" type="submit" name="submit_add_menu"><i class="fa fa-plus fa-icon"></i>Add</button>
                        </form> 
                    </div>
            </div>
        </div>
        <div class="filters" id="filters">
                <div class="filter-header">
                    <div class="title filter-title">Filters </div>
                    <div class="primary-actions">
                        <button id="hideFilter" class="close-button" type="submit" name="search_menu" onclick="hideFilter()"><i class="fa fa-times fa-icon"></i></button>
                    </div>
                </div>
                <form action="<?php echo URL; ?>menus/index" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Name</label></div>
                                <div><input type="text" name="menuName" value="<?php echo $menuName;?>" /></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Description</label></div>
                                <div><input type="text" name="menuDescription" value="<?php echo $menuDescription;?>" /></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Status</label></div>
                                <div>
                                    <select id="menuStatus" name="menuStatus" value="">
                                        <option value=""></option>
                                        <option value="Available" <?php if ($menuStatus == "Available") echo 'selected';?>>Available</option>
                                        <option value="Not Available" <?php if ($menuStatus == "Not Available") echo 'selected';?>>Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Price</label></div>
                                <div><input type="text" name="price" value="<?php echo $price;?>" /></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Rating</label></div>
                                <div>
                                    <select id="rating" name="rating" value="" > 
                                        <option value=""></option>
                                        <option value="Normal" <?php if ($rating == "Normal") echo 'selected';?>>Normal</option>
                                        <option value="Recommended" <?php if ($rating == "Recommended") echo 'selected';?>>Recommended</option>
                                        <option value="Best Seller" <?php if ($rating == "Best Seller") echo 'selected';?>>Best Seller</option>
                                        <option value="New" <?php if ($rating == "New") echo 'selected';?>>New</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="" >
                                        <option value=""></option>
                                        <option value="0" <?php if ($archived == "0") echo 'selected';?>>False</option>
                                        <option value="1" <?php if ($archived == "1") echo 'selected';?>>True</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Category</label></div>
                                <div>
                                    <select id="category" name="category" value="" >
                                    <option value=""></option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php if (isset($category->id)) echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>"
                                        <?php if ($categoryId == $category->id) echo 'selected';?>>
                                        <?php if (isset($category->description)) echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Sub Category</label></div>
                                <div>
                                    <select id="subCategory" name="subCategory" value="">
                                        <option value=""></option>
                                        <option value="Solo" <?php if ($subCategory == "Solo") echo 'selected';?>>Solo</option>
                                        <option value="Regular" <?php if ($subCategory == "Regular") echo 'selected';?>>Regular</option>
                                        <option value="Big" <?php if ($subCategory == "Big") echo 'selected';?>>Big</option>
                                        <option value="Affagato" <?php if ($subCategory == "Affagato") echo 'selected';?>>Affagato</option>
                                        <option value="Italian" <?php if ($subCategory == "Italian") echo 'selected';?>>Italian</option>
                                        <option value="Small" <?php if ($subCategory == "Small") echo 'selected';?>>Small</option>
                                        <option value="Medium" <?php if ($subCategory == "Medium") echo 'selected';?>>Medium</option>
                                        <option value="Large" <?php if ($subCategory == "Large") echo 'selected';?>>Large</option>
                                        <option value="Hot" <?php if ($subCategory == "Hot") echo 'selected';?>>Hot</option>
                                        <option value="Iced" <?php if ($subCategory == "Iced") echo 'selected';?>>Iced</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Allergen</label></div>
                                <div>
                                    <select id="allergen" name="allergen" value="">
                                    <option value=""></option>
                                    <?php foreach ($allergens as $allergen) { ?>
                                        <option 
                                            value="<?php if (isset($allergen->id)) echo htmlspecialchars($allergen->id, ENT_QUOTES, 'UTF-8'); ?>"
                                            <?php if ($allergen->id ==  $allergenId) echo 'selected';?>
                                        >
                                        <?php if (isset($allergen->description)) echo htmlspecialchars($allergen->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <button class="primary-button" type="submit" name="submit_search_menu" ><i class="fa fa-check fa-icon"></i>Submit</button>
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
                    <td></td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td>Price</td>
                    <td>Rating</td>
                    <td>Archived</td>
                    <td>Category</td>
                    <td>Sub Category</td>
                    <td>Allergen</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($menus as $menu) { ?>
                    <tr>
                        <td class="menu-thumbnail"><img scr="" class="menu-thumbnail"/></td>
                        <td><?php if (isset($menu->menuName)) echo htmlspecialchars($menu->menuName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->menuDescription)) echo htmlspecialchars($menu->menuDescription, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->menuStatus)) echo htmlspecialchars($menu->menuStatus, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->price)) echo htmlspecialchars($menu->price, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->rating)) echo htmlspecialchars($menu->rating, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td ><?php if (isset($menu->archived)) echo htmlspecialchars($menu->archived, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->category)) echo htmlspecialchars($menu->category, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->subCategory)) echo htmlspecialchars($menu->subCategory, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php if (isset($menu->allergen)) echo htmlspecialchars($menu->allergen, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a class="list-action" href="<?php echo URL . 'menus/deletemenu/' . htmlspecialchars($menu->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fab fa-nintendo-switch"></i></a>
                            <a class="list-action" href="<?php echo URL . 'menus/editmenu/' . htmlspecialchars($menu->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fa fa-pencil fa-icon"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
