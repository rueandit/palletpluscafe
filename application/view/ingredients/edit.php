<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-shopping-bag display-icon"></i>Edit Ingredient</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>ingredients/updateingredient" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Name</label></div>
                                <div><input type="text" name="name" value="<?php if (isset($ingredient->name)) echo htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8'); ?>"  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Description</label></div>
                                <div><input type="text" name="description" value="<?php if (isset($ingredient->description)) echo htmlspecialchars($ingredient->description, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Amount</label></div>
                                <div><input type="number" name="amount" value="<?php if (isset($ingredient->amount)) echo htmlspecialchars($ingredient->amount, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Unit</label></div>
                                <div><input type="text" name="unit" value="<?php if (isset($ingredient->unit)) echo htmlspecialchars($ingredient->unit, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="">
                                        <option value="0" <?php if ($ingredient->archived == "0") echo 'selected';?>>False</option>
                                        <option value="1" <?php if ($ingredient->archived == "1") echo 'selected';?>>True</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Photo</label></div>
                                <div>
                                    <select id="imageId" name="imageId" value="">
                                    <?php foreach ($images as $image) { ?>
                                        <option 
                                        value="<?php if (isset($image->id)) echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8'); ?>"
                                        <?php if ($image->id ==  $ingredient->imageId) echo 'selected';?>
                                        >
                                        <?php if (isset($image->description)) echo htmlspecialchars($image->description, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <input type="hidden" name="ingredient_id" value="<?php echo htmlspecialchars($ingredient->id, ENT_QUOTES, 'UTF-8'); ?>" />
                                <button class="primary-button" type="submit" name="submit_update_ingredient" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>