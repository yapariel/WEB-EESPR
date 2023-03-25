<div class="modal fade" id="addcourse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Course</h3>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label class="control-label">Course Code</label>
                        <input type="hidden" id="course_id" name="course_id">
                        <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                        <input type="text" class="form-control" id="course_code" name="course_code">
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Course Description</label>
                        <input type="text" class="form-control" id="course_name" name="course_name">
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Passing Score</label>
                        <input type="number" class="form-control" id="passing_score" name="passing_score">
                        <span class="help-inline"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <a id="btn-save" class="btn btn-primary" onclick="save()">Submit</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>