<div class="menu-container">
    <div class="list-header">    
        <div class="title"><i class="fas fa-hockey-puck display-icon"></i>Edit Table</div>
    </div>
    <div class="add-edit" id="add-edit">
        <form action="<?php echo URL; ?>tables/updatetable" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                        <div><label >Name</label></div>
                        <div><input type="text" name="name" value="<?php if (isset($table->name)) echo htmlspecialchars($table->name, ENT_QUOTES, 'UTF-8'); ?>"  required/></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label >Description</label></div>
                        <div><input type="text" name="description" value="<?php if (isset($table->description)) echo htmlspecialchars($table->description, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                        <div><label >Archived</label></div>
                        <div>
                            <select id="archived" name="archived" value="">
                                <option value="0" <?php if ($table->archived == "0") echo 'selected';?>>False</option>
                                <option value="1" <?php if ($table->archived == "1") echo 'selected';?>>True</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                        <input type="hidden" name="table_id" value="<?php echo htmlspecialchars($table->id, ENT_QUOTES, 'UTF-8'); ?>" />
                        <button class="primary-button" type="submit" name="submit_update_table" ><i class="fas fa-check display-icon"></i>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>