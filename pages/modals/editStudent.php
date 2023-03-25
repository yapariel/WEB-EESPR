<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa fa-user"></i> Add Examinee</h3>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" name="id" id="id"/>
                            <input type="hidden" name="user_id" id="user_id"/>
                            <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                            <div class="form-group">
                                <label>Examinee ID</label>
                                <input type="text" class="form-control" name="u_studid" id="u_studid" placeholder="Examinee ID" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="u_fname" id="u_fname" placeholder="Firstname" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="u_lname" id="u_lname" placeholder="Lastname" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="u_email" id="u_email" placeholder="Email Address" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" id="u_gender" name="u_gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="text" class="form-control" name="u_mobileno" id="u_mobileno" placeholder="Mobile No" />
                                <span class="help-inline"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="u_address" id="u_address" placeholder="Address"></textarea>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="u_birthdate" id="u_birthdate"/>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Date Graduated</label>
                                <input type="date" class="form-control" name="u_graduated" id="u_graduated"/>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Last School Attended</label>
                                <input type="text" class="form-control" name="u_last_school" id="u_last_school" placeholder="Last School Attended" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Preferred Course</label>
                                <select class="form-control" id="u_pref_course" name="u_pref_course">
                                </select>
                                <span class="help-inline"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:update()" class="btn btn-primary"> Save</a>
                 <a href="javascript:clearEdit()" class="btn btn-warning"> Reset</a>
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                </form>
            </div>
        </div>
    </div>
</div>
