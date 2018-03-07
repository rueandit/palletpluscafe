<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-hockey-puck display-icon"></i>Tables List</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_tables" ><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_tables" ><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                    <div class="add">
                        <form action="<?php echo URL; ?>tables/addTable" method="POST">
                            <button class="primary-button" type="submit" name="submit_add_table"><i class="fas fa-plus-circle display-icon"></i>Add</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="filters" id="filters">
            <div class="filter-header">
                <div class="title filter-title">Filters </div>
            </div>
            <form action="<?php echo URL; ?>tables/index" method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                            <div><label >Name</label></div>
                            <div><input type="text" name="name" value="<?php echo $name;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                            <div><label >Description</label></div>
                            <div><input type="text" name="description" value="<?php echo $description;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
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
                            <button class="primary-button" type="submit" name="submit_search_table" ><i class="fas fa-check display-icon"></i>Submit</button>
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
                <td>Name</td>
                <td class="td-small">Description</td>
                <td class="td-small">Archived</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tables as $table) { ?>
                <tr>
                    <td><?php if (isset($table->name)) echo htmlspecialchars($table->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($table->description)) echo htmlspecialchars($table->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="td-small"><?php if (isset($table->archived)) echo htmlspecialchars($table->archived, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="list-action" href="<?php echo URL . 'tables/edittable/' . htmlspecialchars($table->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-edit display-icon"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
