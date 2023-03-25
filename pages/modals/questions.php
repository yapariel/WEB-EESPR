<div class="modal fade" id="questionsModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" id="frmQuestions" enctype="multipart/form-data">
                <div class="modal-header">
                    <p>Question | You can add image if needed</p>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="question_id" id="question_id">
                    <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category_id" name="category_id"></select>
                    </div>
                    <div class="form-group">
                        <label>Question</label>
                        <textarea class="ckeditor" name="content" id="content"></textarea>
                    </div>
                    <div class="form-group well">
                        <input type="file" name="mainpic" id="mainpic" class="form-control" accept="image/*" />
                        <p class="help-inline"></p>
                    </div>
                    <div class="form-group well">
                        <label>Correct Answer</label>
                        <input type="text" name="answer" id="answer" class="form-control answer"/>
                        <p class="help-inline"></p>
                        <input type="file" name="correctpic" id="correctpic" class="form-control" accept="image/*" />
                    </div>
                    <div class="form-group well">
                        <label>Choice 2</label>
                        <input type="text" name="choice2" id="choice2" class="form-control answer"/> 
                        <p class="help-inline"></p>
                        <input type="file" name="pic2" id="pic2" class="form-control" accept="image/*" />
                    </div>
                    <div class="form-group well">                
                        <label>Choice 3</label>
                        <input type="text" name="choice3" id="choice3" class="form-control answer"/> 
                        <p class="help-inline"></p>
                        <input type="file" name="pic3" id="pic3" class="form-control" accept="image/*" />
                    </div>
                    <div class="form-group well">
                        <label>Choice 4</label>
                        <input type="text" name="choice4" id="choice4" class="form-control answer"/>
                        <p class="help-inline"></p>
                        <input type="file" name="pic4" id="pic4" class="form-control" accept="image/*" />
                    </div>
                    <input type="hidden" name="answerid" id="answerid"/>
                    <input type="hidden" name="choice2id" id="choice2id"/>
                    <input type="hidden" name="choice3id" id="choice3id"/>
                    <input type="hidden" name="choice4id" id="choice4id"/>  
                    
                    <input type="hidden" name="tmp_main" id="tmp_main"/>
                    <input type="hidden" name="tmp_correct" id="tmp_correct"/>
                    <input type="hidden" name="tmp_pic2" id="tmp_pic2"/>
                    <input type="hidden" name="tmp_pic3" id="tmp_pic3"/>
                    <input type="hidden" name="tmp_pic4" id="tmp_pic4"/>
                </div>
                <div class="modal-footer">
                    <a onclick="save()" id="btn-save" class="btn btn-primary">Submit</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
