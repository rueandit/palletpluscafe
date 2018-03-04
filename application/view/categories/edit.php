<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-tags display-icon"></i> Edit Menu Item</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>categories/updatecategory" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Code</label></div>
                                <div><input type="text" name="code" value="<?php if (isset($category->code)) echo htmlspecialchars($category->code, ENT_QUOTES, 'UTF-8'); ?>"  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Description</label></div>
                                <div><input type="text" name="description" value="<?php if (isset($category->description)) echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="">
                                        <option value="0" <?php if ($category->archived == "0") echo 'selected';?>>False</option>
                                        <option value="1" <?php if ($category->archived == "1") echo 'selected';?>>True</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>" />
                                <button class="primary-button" type="submit" name="submit_update_category" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>