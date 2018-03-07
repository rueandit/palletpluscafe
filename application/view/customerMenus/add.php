<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-utensils display-icon"></i>Add Menu Item</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>menus/submitmenu" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Name</label></div>
                                <div><input type="text" name="menuName" value=""  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Description</label></div>
                                <div><input type="text" name="menuDescription" value="" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Status</label></div>
                                <div>
                                    <select id="menuStatus" name="menuStatus" value="" required>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Price</label></div>
                                <div><input type="number" name="price" value="" required/></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Rating</label></div>
                                <div>
                                    <select id="rating" name="rating" value="" required>
                                        <option value="Normal">Normal</option>
                                        <option value="Recommended">Recommended</option>
                                        <option value="Best Seller">Best Seller</option>
                                        <option value="New">New</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="" required>
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Category</label></div>
                                <div>
                                    <select id="category" name="category" value="" required>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php if (isset($category->id)) echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($category->description)) echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Sub Category</label></div>
                                <div>
                                    <select id="subCategory" name="subCategory" value="" >
                                        <option value=""></option>
                                        <option value="Solo">Solo</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Big">Big</option>
                                        <option value="Affagato">Affagato</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Large">Large</option>
                                        <option value="Hot">Hot</option>
                                        <option value="Iced">Iced</option>
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
                                        <option value="<?php if (isset($allergen->id)) echo htmlspecialchars($allergen->id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($allergen->description)) echo htmlspecialchars($allergen->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Photo</label></div>
                                <div><input type="text" name="imageFile" value="" required/></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <button class="primary-button" type="submit" name="submit_add_menu" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>