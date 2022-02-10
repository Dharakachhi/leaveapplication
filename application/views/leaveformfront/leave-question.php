<?php if(!empty($leave_detail)){
    foreach($leave_detail as $detailVal){ ?>
        <?php if(@$detailVal['input_type'] == 'Text'){ ?>
            <div class="col-md-6">
                <?php $textAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if(@$detailVal['isMandatory'] == '1'){
                    $required = 'required';
                    $requiredText = ' <span class="required">*</span>';
                } else{
                    $required = '';
                    $requiredText = '';
                } ?>
                <div class="form-group">
                    <label class="control-label"><?php echo @$detailVal['leave_question'].@$requiredText; ?></label>
                    <input type="text" name="<?php echo @$textAlias; ?>" id="<?php echo @$textAlias; ?>" class="form-control textEvent" data-id="<?php echo @$detailVal['leave_question_id']; ?>" <?php echo @$required; ?>>
                </div>
            </div>
            <div class="" style="padding: 0; display: none;" id="textDiv"></div>
        <?php } ?>
        <?php if(@$detailVal['input_type'] == 'Date'){ ?>
            <div class="col-md-6">
                <?php $dateAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if(@$detailVal['isMandatory'] == '1'){
                    $required = 'required';
                    $requiredText = ' <span class="required">*</span>';
                } else{
                    $required = '';
                    $requiredText = '';
                } ?>
                <div class="form-group">
                    <label class="control-label"><?php echo @$detailVal['leave_question'].@$requiredText; ?></label>
                    <input type="text" name="<?php echo @$dateAlias; ?>" id="<?php echo @$dateAlias; ?>" class="form-control fieldDate1 dateEvent" data-loop="0" data-id="<?php echo @$detailVal['leave_question_id']; ?>" <?php echo @$required; ?>>
                </div>
            </div>
            <div class="" style="padding: 0; display: none;" id="dateDiv"></div>
        <?php } ?>
        <?php if(@$detailVal['input_type'] == 'Checkbox'){ ?>
        <div class="col-md-6">
            <?php $checkboxAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if(@$detailVal['isMandatory'] == '1'){
                    $requiredText = ' <span class="required">*</span>';
                } else{
                    $requiredText = '';
                } ?>
            <div class="form-group">
                <label class="control-label"><?php echo @$detailVal['leave_question'].@$requiredText; ?></label>
                <div class="row">
                    <?php if(!empty($question_detail)):
                        $i = 0;
                        foreach($question_detail as $quesVal):
                            if(@$quesVal['leave_question_id'] == @$detailVal['leave_question_id']): 
                                if($i == 0){
                                    if(@$detailVal['isMandatory'] == '1'){
                                        $required = 'required';
                                    } else{
                                        $required = '';
                                    }
                                } else{
                                    $required = '';
                                }
                                $i++; ?>
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="<?php echo @$checkboxAlias; ?>" class="checkboxEvent" data-id="<?php echo @$quesVal['leave_question_id']; ?>" value="<?php echo @$quesVal['leave_question_detail_id']; ?>" <?php echo @$required; ?>> <?php echo @$quesVal['lable_name']; ?></label>
                                </div>
                    <?php endif; endforeach; endif; ?>
                </div>
                <label id="<?php echo @$checkboxAlias; ?>-error" class="error" for="<?php echo @$checkboxAlias; ?>" style="display: none;"></label>
            </div>
        </div>
        <div class="" style="padding: 0; display: none;" id="checkboxDiv"></div>
        <?php } ?>
        <?php if(@$detailVal['input_type'] == 'Dropdown'){ ?>
        <div class="col-md-6">
            <?php $dropdownAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
            if(@$detailVal['isMandatory'] == '1'){
                $required = 'required';
                $requiredText = ' <span class="required">*</span>';
            } else{
                $required = '';
                $requiredText = '';
            } ?>
            <div class="form-group">
                <label class="control-label"><?php echo @$detailVal['leave_question'].@$requiredText; ?></label>
                <select name="<?php echo @$dropdownAlias; ?>" data-id="<?php echo @$detailVal['leave_question_id']; ?>" id="<?php echo @$dropdownAlias; ?>" class="form-control select2drop dropdownEvent" <?php echo @$required; ?>>
                    <option value="">Select Option</option>
                    <?php if(!empty($question_detail)):
                        foreach($question_detail as $quesVal):
                            if(@$quesVal['leave_question_id'] == @$detailVal['leave_question_id']): ?>
                                <option value="<?php echo @$quesVal['leave_question_detail_id']; ?>"><?php echo @$quesVal['lable_name']; ?></option>
                    <?php endif; endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="" style="padding: 0; display: none;" id="dropdownDiv"></div>
        <?php } ?>
<?php } } ?>

<script type="text/javascript">
    $(function(){
        $('.select2drop').select2();

        $(".fieldDate1").datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });
</script>