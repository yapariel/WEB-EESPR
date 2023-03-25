<div class="modal fade" id="addstudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa fa-user"></i> Add Student</h3>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                            <div class="form-group">
                                <label>Examinee ID</label>
                                <input type="text" class="form-control" name="studid" id="studid" placeholder="Examinee ID" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Firstname" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Lastname" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile No" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="birthdate" id="birthdate"/>
                                <span class="help-inline"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date Graduated</label>
                                <input type="date" class="form-control" name="graduated" id="graduated"/>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Last School Attended</label>
                                <input type="text" class="form-control" name="last_school" id="last_school" placeholder="Last School Attended" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Preferred Course</label>
                                <select class="form-control" id="pref_course" name="pref_course">
                                </select>
                                <span class="help-inline"></span>
                            </div>
                            <br><hr>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username"/>
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                <span class="help-inline"></span>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" />
                                <span class="help-inline"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <a id="btn-save" class="btn btn-primary" onclick="save()">Submit</a>
                 <a href="javascript:clear()" class="btn btn-warning"> Reset</a>
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                </form>
            </div>
        </div>
    </div>
</div>
