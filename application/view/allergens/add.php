<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-syringe display-icon"></i>Add Menu Item</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>allergens/submitallergen" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Code</label></div>
                                <div><input type="text" name="code" value=""  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Description</label></div>
                                <div><input type="text" name="description" value="" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="">
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <button class="primary-button" type="submit" name="submit_add_allergen" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>