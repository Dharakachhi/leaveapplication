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
                <span>Create Leave Question Detail</span>
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
                            <form action="<?php echo base_url('insert-leavequestion'); ?>" name="form_leavequestion" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Type <span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="parent_leave_id" id="parent_leave_id" value="0">
                                            <select name="parent_leave" id="parent_leave" data-id="0" class="form-control select2">
                                                <option value="">Select Leave</option>
                                                <?php if(!empty($leave_type)):
                                                    foreach($leave_type as $leaveVal): ?>
                                                        <option value="<?php echo @$leaveVal['leave_type_id']; ?>"><?php echo @$leaveVal['leave_type_name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <label id="parent_leave-error" class="error" for="parent_leave"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Question <span class="required">*</span> :</label>
                                        <div class="col-md-9">
                                            <input type="text" name="question_name" id="question_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Question type</label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Text" checked=""> Text </label>
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Checkbox"> Checkbox </label>
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Dropdown"> Dropdown </label>
                                                <label>
                                                    <input type="radio" name="input_type" class="icheck inputType" data-radio="iradio_square-grey" value="Date"> Date </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="input_lable_div" style="display: none;">
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
                                                <table id="tbl_input_lable" style="display: none;">
                                                    <thead>
                                                        <tr>
                                                            <th width="30%">Lable</th>
                                                            <th width="25%">Order</th>
                                                            <th width="15%"></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <label>
                                                <input type="checkbox" name="is_subquestion" id="is_subquestion" value="1"> Is SubQuestion </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Related Question:</label>
                                        <div class="col-md-9" id="relatedQuestion">
                                            <select name="related_question" id="related_question" class="form-control select2" disabled="">
                                                <option id="0" value="">Select Related Question</option>
                                            </select>
                                            <label id="related_question-error" class="error" for="related_question"></label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="question_option" style="display: none;"></div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="is_mandatory" id="is_mandatory" value="1"> Is Mandatory </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="radio" name="leave_status" class="icheck" data-radio="iradio_square-grey" value="1" checked=""> Active </label>
                                                <label>
                                                    <input type="radio" name="leave_status" class="icheck" data-radio="iradio_square-grey" value="0"> In Active </label>
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