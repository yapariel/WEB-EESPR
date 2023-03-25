<div class="modal fade" id="keyStudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa fa-user"></i> Update Account</h3>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="key_id" id="key_id"/>
                    <input type="hidden" name="key_user_id" id="key_user_id"/>
                    <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="key_username" id="key_username" placeholder="Username"/>
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="key_password" id="key_password" placeholder="Password" />
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="key_password2" id="key_password2" placeholder="Confirm Password" />
                        <span class="help-inline"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:updateAccount()" class="btn btn-primary"> Save</a>
                 <a href="javascript:clearkey()" class="btn btn-warning"> Reset</a>
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                </form>
            </div>
        </div>
    </div>
</div>
