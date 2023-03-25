<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Manage Exam. Schedule</h3>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label class="control-label">Description:</label>
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                        <input type="text" class="form-control" id="description" name="description">
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Start Time:</label>
                        <input type="time" class="form-control" id="start_time" name="start_time">
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">End Time:</label>
                        <input type="time" class="form-control" id="end_time" name="end_time">
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