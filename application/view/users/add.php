<div class="menu-container">
        <div class="list-header">    
            <div class="title"><i class="fas fa-users display-icon"></i> Add Menu Item</div>
        </div>
        <div class="add-edit" id="add-edit">
                <form action="<?php echo URL; ?>users/submitUser" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 input-item" >
                                <div><label >Username</label></div>
                                <div><input type="text" name="username" value=""  required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Password</label></div>
                                <div><input type="text" name="userPassword" value="" required/></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3  col-lg-3 input-item">
                                <div><label >Type</label></div>
                                <div>
                                    <select id="userType" name="userType" value="">
                                        <option value="superadmin">Super Administrator</option>
                                        <option value="admin">Administrator</option>
                                        <option value="cashier">Cashier</option>
                                        <option value="waiter">Waiter</option>
                                        <option value="kitchen">Kitchen</option>
                                    </select>
                                </div>
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
                                <button class="primary-button" type="submit" name="submit_add_user" ><i class="fas fa-check display-icon"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
</div>