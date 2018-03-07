<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-syringe display-icon"></i>Allergen List</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_allergens" ><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_allergens" ><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                    <div class="add">
                        <form action="<?php echo URL; ?>allergens/addAllergen" method="POST">
                            <button class="primary-button" type="submit" name="submit_add_allergen"><i class="fas fa-plus-circle display-icon"></i>Add</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="filters" id="filters">
            <div class="filter-header">
                <div class="title filter-title">Filters </div>
            </div>
            <form action="<?php echo URL; ?>allergens/index" method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item" >
                            <div><label >Code</label></div>
                            <div><input type="text" name="code" value="<?php echo $code;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-3 input-item">
                            <div><label >Description</label></div>
                            <div><input type="text" name="description" value="<?php echo $description;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-3 input-item">
                            <div><label >Archived</label></div>
                            <div>
                                <select id="archived" name="archived" value="">
                                    <option value=""></option>
                                    <option value="0" <?php if ($archived == "False") echo 'selected';?>>False</option>
                                    <option value="1" <?php if ($archived == "True") echo 'selected';?>>True</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                            <button class="primary-button" type="submit" name="submit_search_allergen" ><i class="fas fa-check display-icon"></i>Submit</button>
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
                <td>Code</td>
                <td class="td-small">Description</td>
                <td class="td-small">Archived</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allergens as $allergen) { ?>
                <tr>
                    <td><?php if (isset($allergen->code)) echo htmlspecialchars($allergen->code, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($allergen->description)) echo htmlspecialchars($allergen->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($allergen->archived)) echo htmlspecialchars($allergen->archived, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="list-action" href="<?php echo URL . 'allergens/editallergen/' . htmlspecialchars($allergen->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-edit display-icon"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
