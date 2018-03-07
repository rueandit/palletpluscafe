<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-shopping-bag display-icon"></i>Ingredient List</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_ingredients" ><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_ingredients" ><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                    <div class="add">
                        <form action="<?php echo URL; ?>ingredients/addIngredient" method="POST">
                            <button class="primary-button" type="submit" name="submit_add_ingredient"><i class="fas fa-plus-circle display-icon"></i>Add</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="filters" id="filters">
            <div class="filter-header">
                <div class="title filter-title">Filters </div>
            </div>
            <form action="<?php echo URL; ?>ingredients/index" method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item" >
                            <div><label >Name</label></div>
                            <div><input type="text" name="name" value="<?php echo $name;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Description</label></div>
                            <div><input type="text" name="description" value="<?php echo $description;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-3 input-item">
                            <div><label >Amount</label></div>
                            <div><input type="number" name="amount" value="<?php echo $amount;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Unit</label></div>
                            <div><input type="text" name="unit" value="<?php echo $unit;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item">
                            <div><label >Archived</label></div>
                            <div>
                                <select id="archived" name="archived" value="">
                                    <option value=""></option>
                                    <option value="0" <?php if ($archived == "0") echo 'selected';?>>False</option>
                                    <option value="1" <?php if ($archived == "1") echo 'selected';?>>True</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                            <button class="primary-button" type="submit" name="submit_search_ingredient" ><i class="fas fa-check display-icon"></i>Submit</button>
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
                <td class="td-small">Description</td>
                <td class="td-small">Amount</td>
                <td class="td-small">Unit</td>
                <td class="td-small">Archived</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ingredients as $ingredient) { ?>
                <tr>
                    <td class="menu-thumbnail"><img src="<?php echo URL; ?>img/bf1.jpg" class="menu-thumbnail"/></td>
                    <td><?php if (isset($ingredient->name)) echo htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->description)) echo htmlspecialchars($ingredient->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->amount)) echo htmlspecialchars($ingredient->amount, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->unit)) echo htmlspecialchars($ingredient->unit, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($ingredient->archived)) echo htmlspecialchars($ingredient->archived, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="list-action" href="<?php echo URL . 'ingredients/editingredient/' . htmlspecialchars($ingredient->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-edit display-icon"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
