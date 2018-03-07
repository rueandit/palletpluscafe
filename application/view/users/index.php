<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-users display-icon"></i> User Accounts List</div>
            <div class="primary-actions">
                <div class="search-bar">
                    <div class="filter">
                        <button id="showFilter" class="primary-button showFilter" type="submit" name="search_users" ><i class="fa fa-filter display-icon"></i> Show Filter</button>
                        <button id="hideFilter" class="primary-button hideFilter" type="submit" name="search_users" ><i class="fa fa-filter display-icon"></i> Hide Filter</button>
                    </div>
                    <div class="add">
                        <form action="<?php echo URL; ?>users/addUser" method="POST">
                            <button class="primary-button" type="submit" name="submit_add_user"><i class="fas fa-plus-circle display-icon"></i>Add</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="filters" id="filters">
            <div class="filter-header">
                <div class="title filter-title">Filters </div>
            </div>
            <form action="<?php echo URL; ?>users/index" method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 input-item" >
                            <div><label >Username</label></div>
                            <div><input type="text" name="username" value="<?php echo $username;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-3 input-item">
                            <div><label >User Type</label></div>
                            <div><input type="text" name="userType" value="<?php echo $userType;?>" /></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-3 input-item">
                            <div><label >Archived</label></div>
                            <div>
                                <select id="Archived" name="archived" value="">
                                    <option value=""></option>
                                    <option value="0" <?php if ($archived == "0") echo 'selected';?>>False</option>
                                    <option value="1" <?php if ($archived == "1") echo 'selected';?>>True</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                            <button class="primary-button" type="submit" name="submit_search_users" ><i class="fas fa-check display-icon"></i>Submit</button>
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
                    <td>Username</td>
                    <td class="td-small">Password</td>
                    <td class="td-small">Type</td>
                    <td class="td-small">Archived</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php if (isset($user->username)) echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="td-small"><?php if (isset($user->userPassword)) echo htmlspecialchars($user->userPassword, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="td-small"><?php if (isset($user->userType)) echo htmlspecialchars($user->userType, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="td-small"><?php if (isset($user->archived)) echo htmlspecialchars($user->archived, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a class="list-action" href="<?php echo URL . 'users/edituser/' . htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-edit display-icon"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
