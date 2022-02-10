<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Edit Leave Question Detail</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('leave-question'); ?>" class="btn btngreen"><i class="fa fa-long-arrow-left backbtn" aria-hidden="true"></i>Back</a>
            </li>
        </ul>
        
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-2"></div>
                <div class="col-md-9 col-sm-9">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo base_url('update-leavequestion'); ?>" name="form_leavequestion" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <input type="hidden" name="question_id" id="question_id" class="form-control" value="<?php echo @$single_leave['leave_question_id'] ?>">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Type <span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="parent_leave_id" id="parent_leave_id" value="<?php echo @$single_leave['parent_id']; ?>">
                                            <select name="parent_leave" id="parent_leave" data-id="<?php echo @$single_leave['leave_question_id'] ?>" class="form-control" >
                                                <option value="">Select Leave</option>
                                                <?php if(!empty($leave_type)):
                                                    foreach($leave_type as $leaveVal):
                                                        if(@$single_leave['parent_id'] == @$leaveVal['leave_type_id']){
                                                            $select = 'selected';
                                                        } else{
                                                            $select = '';
                                                        } ?>
                                                        <option value="<?php echo @$leaveVal['leave_type_id']; ?>" <?php echo @$select; ?>><?php echo @$leaveVal['leave_type_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Question <span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="text" name="question_name" id="question_name" class="form-control" value="<?php echo @$single_leave['leave_question'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Question type</label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Text" <?php if(@$single_leave['input_type'] == 'Text'){ echo "checked"; } ?>> Text </label>
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Checkbox" <?php if(@$single_leave['input_type'] == 'Checkbox'){ echo "checked"; } ?>> Checkbox </label>
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Dropdown" <?php if(@$single_leave['input_type'] == 'Dropdown'){ echo "checked"; } ?>> Dropdown </label>
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Date" <?php if(@$single_leave['input_type'] == 'Date'){ echo "checked"; } ?>> Date </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(@$single_leave['input_type'] == 'Checkbox' || @$single_leave['input_type'] == 'Dropdown'){ 
                                            $display = 'style="display: block;"';
                                        } else{
                                            $display = 'style="display: none;"';
                                        } ?>
                                    <div id="input_lable_div" <?php echo @$display; ?>>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Input Lable</label>
                                            <div class="col-md-6">
                                                <input type="text" name="input_lable" id="input_lable" class="form-control">
                                                <label id="input_lable-error" class="error"></label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="input_lable_order" id="input_lable_order" class="form-control">
                                                <label id="input_lable_order-error" class="error"></label>
                                            </div>
                                            <div class="col-md-1">
                                                <a id="addInputLable"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <table id="tbl_input_lable">
                                                    <thead>
                                                        <tr>
                                                            <th width="30%">Lable</th>
                                                            <th width="25%">Order</th>
                                                            <th width="15%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(!empty(@$single_leave_detail)):
                                                            foreach($single_leave_detail as $detail): ?>
                                                                <tr>
                                                                    <td><input type="hidden" name="lable_name[]" value="<?php echo @$detail['lable_name']; ?>"><?php echo @$detail['lable_name']; ?></td>
                                                                    <td><input type="hidden" name="lable_order[]" value="<?php echo @$detail['lable_order']; ?>"><?php echo @$detail['lable_order']; ?></td>
                                                                    <td><a class="removeInputLable">Remove</a></td></td>
                                                                </tr>
                                                        <?php endforeach; endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <label>
                                                <input type="checkbox" name="is_subquestion" id="is_subquestion" value="1" <?php if(@$single_leave['isSubquestion'] != '0'){ echo "checked"; } ?>> Is SubQuestion </label>
                                        </div>
                                    </div>
                                    <?php if(@$single_leave['isSubquestion'] == '0'){ 
                                            $status = 'disabled';
                                            $display = 'style="display: none;"';
                                        } else{
                                            $status = '';
                                            $display = 'style="display: block;"';
                                        } ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Related Question:</label>
                                        <div class="col-md-9" id="relatedQuestion">
                                            <select name="related_question" id="related_question" class="form-control select2" <?php echo @$status; ?>>
                                                <option id="0" value="">Select Related Question</option>
                                                <?php if(!empty($leave_question)):
                                                    foreach($leave_question as $leaveVal):
                                                        if(@$single_leave['related_question'] == @$leaveVal['leave_question_id']){
                                                            $select = 'selected';
                                                        } else{
                                                            $select = '';
                                                        } ?>
                                                        <option id="<?php echo @$leaveVal['input_type']; ?>" value="<?php echo @$leaveVal['leave_question_id']; ?>" <?php echo @$select; ?> ><?php echo @$leaveVal['leave_question']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="related_question-error" class="error" for="related_question"></label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="question_option" <?php echo @$display; ?>>
                                        <label class="col-md-3 control-label">Question Option:</label>
                                        <div class="col-md-9">
                                            <select name="related_question_option" id="related_question_option" class="form-control select2">
                                                <option value="">Select Question Option</option>
                                                <?php if(!empty($related_question_detail)):
                                                    foreach($related_question_detail as $questionVal): 
                                                        if(@$single_leave['related_question_option'] == @$questionVal['leave_question_detail_id']){
                                                            $select = 'selected';
                                                        } else{
                                                            $select = '';
                                                        } ?>
                                                    <option value="<?php echo @$questionVal['leave_question_detail_id']; ?>" <?php echo @$select; ?>><?php echo @$questionVal['lable_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="related_question_option-error" class="error" for="related_question_option"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="is_mandatory" id="is_mandatory" value="1" <?php if(@$single_leave['isMandatory'] == '1'){ echo "checked"; } ?>> Is Mandatory </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="leave_status" class="icheck" data-radio="iradio_square-grey" value="1" <?php if(@$single_leave['isActive'] == '1'){ echo "checked"; } ?>> Active </label>
                                                <label>
                                                    <input type="radio" name="leave_status" class="icheck" data-radio="iradio_square-grey" <?php if(@$single_leave['isActive'] == '0'){ echo "checked"; } ?> value="0"> In Active </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="submit" id="leaveQuestionbtn" class="btn btngreen">Save</button>
                                            <a href="<?php echo base_url('leave-question'); ?>" class="btn default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
<!-- END CONTENT BODY -->