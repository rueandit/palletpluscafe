<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-users display-icon"></i> Edit User Account</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>users/updateUser" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Username</label></div>
                                <div><input type="text" name="username" value="<?php if (isset($user->username)) echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?>"  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Password</label></div>
                                <div><input type="text" name="userPassword" value="<?php if (isset($user->userPassword)) echo htmlspecialchars($user->userPassword, ENT_QUOTES, 'UTF-8'); ?>" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Type</label></div>
                                <div>
                                    <select id="userType" name="userType" value="">
                                        <option value="superadmin" <?php if ($user->userType == "superadmin") echo 'selected';?>>Super Administrator</option>
                                        <option value="admin" <?php if ($user->userType == "admin") echo 'selected';?>>Administrator</option>
                                        <option value="cashier" <?php if ($user->userType == "cashier") echo 'selected';?>>Cashier</option>
                                        <option value="waiter" <?php if ($user->userType == "waiter") echo 'selected';?>>Waiter</option>
                                        <option value="kitchen" <?php if ($user->userType == "itchen") echo 'selected';?>>Kitchen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Archived</label></div>
                                <div>
                                    <select id="archived" name="archived" value="">
                                        <option value="0" <?php if ($user->archived == "0") echo 'selected';?>>False</option>
                                        <option value="1" <?php if ($user->archived == "1") echo 'selected';?>>True</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-item input-button">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?>" />
                                <button class="primary-button" type="submit" name="submit_update_user" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>