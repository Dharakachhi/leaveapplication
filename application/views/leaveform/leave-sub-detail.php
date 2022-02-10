<?php if(!empty($leave_question_list)){
    foreach($leave_question_list as $detailVal){ ?>
        <?php if(@$detailVal['input_type'] == 'Text'){
            $textAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
            if (strpos($leave_detail_field, $textAlias) !== false) { ?>
            <div class="col-md-6">
                <?php if(@$detailVal['isMandatory'] == '1'){
                    $required = 'required';
                } else{
                    $required = '';
                } ?>
                <div class="form-group">
                    <label class="control-label"><?php echo @$detailVal['leave_question']; ?></label>
                    <input type="text" name="<?php echo @$textAlias; ?>" id="<?php echo @$textAlias; ?>" class="form-control textEvent1" data-id="<?php echo @$detailVal['leave_question_id']; ?>" <?php echo @$required; ?> value="<?php echo @$leave_detail[$textAlias]; ?>">
                </div>
            </div>
            
            <div class="" style="padding: 0;" id="textDiv"><?php echo get_sub_detail(@$leave_question_detail[$textAlias], @$sub_question_detail[$textAlias], @$leave_detail, $leave_detail_field); ?></div>
        <?php } } ?>
        <?php if(@$detailVal['input_type'] == 'Date'){
            $dateAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
            if (strpos($leave_detail_field, $dateAlias) !== false) { ?>
            <div class="col-md-6">
                <?php if(@$detailVal['isMandatory'] == '1'){
                    $required = 'required';
                } else{
                    $required = '';
                } ?>
                <div class="form-group">
                    <label class="control-label"><?php echo @$detailVal['leave_question']; ?></label>
                    <input type="text" name="<?php echo @$dateAlias; ?>" id="<?php echo @$dateAlias; ?>" class="form-control dateEvent1 fieldDate1edi" data-loop="0" data-id="<?php echo @$detailVal['leave_question_id']; ?>" <?php echo @$required; ?> value="<?php echo @$leave_detail[$dateAlias]; ?>">
                </div>
            </div>
            
            <div class="" style="padding: 0;" id="dateDiv"><?php echo get_sub_detail(@$leave_question_detail[$dateAlias], @$sub_question_detail[$dateAlias], @$leave_detail, $leave_detail_field); ?></div>
        <?php } } ?>
        <?php if(@$detailVal['input_type'] == 'Checkbox'){
        $checkboxAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
        if (strpos($leave_detail_field, $checkboxAlias) !== false) { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label"><?php echo @$detailVal['leave_question']; ?></label>
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
                                $i++;
                                if(@$leave_detail[$checkboxAlias] == @$quesVal['leave_question_detail_id']){
                                    $select = 'checked';
                                } else{
                                    $select = '';
                                } ?>
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="<?php echo @$checkboxAlias; ?>" class="checkboxEvent1" data-id="<?php echo @$quesVal['leave_question_id']; ?>" value="<?php echo @$quesVal['leave_question_detail_id']; ?>" <?php echo @$required." ".@$select; ?>> <?php echo @$quesVal['lable_name']; ?></label>
                                </div>
                    <?php endif; endforeach; endif; ?>
                </div>
                <label id="<?php echo @$checkboxAlias; ?>-error" class="error" for="<?php echo @$checkboxAlias; ?>" style="display: none;"></label>
            </div>
        </div>
        
        <div class="" style="padding: 0;" id="checkboxDiv"><?php echo get_sub_detail(@$leave_question_detail[$checkboxAlias], @$sub_question_detail[$checkboxAlias], @$leave_detail, $leave_detail_field); ?></div>
        <?php } } ?>
        <?php if(@$detailVal['input_type'] == 'Dropdown'){
        $dropdownAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
        if (strpos($leave_detail_field, $dropdownAlias) !== false) { ?>
        <div class="col-md-6">
            <?php if(@$detailVal['isMandatory'] == '1'){
                $required = 'required';
            } else{
                $required = '';
            } ?>
            <div class="form-group">
                <label class="control-label"><?php echo @$detailVal['leave_question']; ?></label>
                <select name="<?php echo @$dropdownAlias; ?>" data-id="<?php echo @$quesVal['leave_question_id']; ?>" id="<?php echo @$dropdownAlias; ?>" class="form-control select2drop dropdownEvent1" <?php echo @$required; ?>>
                    <option value="">Select Option</option>
                    <?php if(!empty($question_detail)):
                        foreach($question_detail as $quesVal):
                            if(@$quesVal['leave_question_id'] == @$detailVal['leave_question_id']):
                            if(@$leave_detail[$dropdownAlias] == @$quesVal['leave_question_detail_id']){
                                    $select = 'selected';
                                } else{
                                    $select = '';
                                } ?>
                                <option value="<?php echo @$quesVal['leave_question_detail_id']; ?>" <?php echo @$select; ?>><?php echo @$quesVal['lable_name']; ?></option>
                    <?php endif; endforeach; endif; ?>
                </select>
            </div>
        </div>
        
        <div class="" style="padding: 0;" id="dropdownDiv"><?php echo get_sub_detail(@$leave_question_detail[$dropdownAlias], @$sub_question_detail[$dropdownAlias], @$leave_detail, $leave_detail_field); ?></div>
        <?php } } ?>
<?php } } ?>

<?php 
function get_sub_detail($leave_question_detail, $sub_question_detail, $leave_detail, $leave_detail_field){
    $subDetail = '';
    if(!empty($leave_question_detail)){
        foreach($leave_question_detail as $detailVal){ 
            if(@$detailVal['input_type'] == 'Text'){
                $textAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if (strpos($leave_detail_field, $textAlias) !== false) {
                    $subDetail .= '<div class="col-md-6">';
                        if(@$detailVal['isMandatory'] == '1'){
                            $required = 'required';
                        } else{
                            $required = '';
                        }
                        $subDetail .= '<div class="form-group">
                            <label class="control-label">'.@$detailVal['leave_question'].'</label>
                            <input type="text" name="'.@$textAlias.'" id="'.@$textAlias.'" class="form-control" data-id="'.@$detailVal['leave_question_id'].'" '.@$required.' value="'.@$leave_detail[$textAlias].'">
                        </div>
                    </div>';
                }
            }
            if(@$detailVal['input_type'] == 'Date'){
                $dateAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if (strpos($leave_detail_field, $dateAlias) !== false) {
                    $subDetail .= '<div class="col-md-6">';
                        if(@$detailVal['isMandatory'] == '1'){
                            $required = 'required';
                        } else{
                            $required = '';
                        }
                        $subDetail .= '<div class="form-group">
                            <label class="control-label">'.@$detailVal['leave_question'].'</label>
                            <input type="text" name="'.@$dateAlias.'" id="'.@$dateAlias.'" class="form-control dateEvent1 fieldDate1edi" data-loop="0" data-id="'.@$detailVal['leave_question_id'].'" '.@$required.' value="'.@$leave_detail[$dateAlias].'">
                        </div>
                    </div>';
                }
            }
            if(@$detailVal['input_type'] == 'Checkbox'){
                $checkboxAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if (strpos($leave_detail_field, $checkboxAlias) !== false) {
                    $subDetail .= '<div class="col-md-6">';
                        $subDetail .= '<div class="form-group">
                            <label class="control-label">'.@$detailVal['leave_question'].'</label>
                            <div class="row">';
                                if(!empty($sub_question_detail)):
                                    $i = 0;
                                    foreach($sub_question_detail as $quesVal):
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
                                            $i++;
                                            if(@$leave_detail[$checkboxAlias] == @$quesVal['leave_question_detail_id']){
                                                $select = 'checked';
                                            } else{
                                                $select = '';
                                            }
                                            $subDetail .= '<div class="col-md-4">
                                                <label>
                                                    <input type="radio" name="'.@$checkboxAlias.'" class="checkboxEvent1" data-id="'.@$quesVal['leave_question_id'].'" value="'.@$quesVal['leave_question_detail_id'].'" '.@$required." ".@$select.'> '.@$quesVal['lable_name'].'</label>
                                            </div>';
                                endif; endforeach; endif;
                            $subDetail .= '</div>
                            <label id="'.@$checkboxAlias.'-error" class="error" for="'.@$checkboxAlias.'" style="display: none;"></label>
                        </div>
                    </div>';
                }
            }
            if(@$detailVal['input_type'] == 'Dropdown'){
                $dropdownAlias = url_title(@$detailVal['leave_question'], 'underscore', true);
                if (strpos($leave_detail_field, $dropdownAlias) !== false) {
                    $subDetail .= '<div class="col-md-6">';
                        if(@$detailVal['isMandatory'] == '1'){
                            $required = 'required';
                        } else{
                            $required = '';
                        }
                        $subDetail .= '<div class="form-group">
                            <label class="control-label">'.@$detailVal['leave_question'].'</label>
                            <select name="'.@$dropdownAlias.'" data-id="'.@$quesVal['leave_question_id'].'" id="'.@$dropdownAlias.'" class="form-control select2drop dropdownEvent1" '.@$required.'>
                                <option value="">Select Option</option>';
                                if(!empty($sub_question_detail)):
                                    foreach($sub_question_detail as $quesVal):
                                        if(@$quesVal['leave_question_id'] == @$detailVal['leave_question_id']):
                                        if(@$leave_detail[$dropdownAlias] == @$quesVal['leave_question_detail_id']){
                                                $select = 'selected';
                                            } else{
                                                $select = '';
                                            }
                                            $subDetail .= '<option value="'.@$quesVal['leave_question_detail_id'].'" '.@$select.'>'.@$quesVal['lable_name'].'</option>';
                                endif; endforeach; endif;
                            $subDetail .= '</select>
                        </div>
                    </div>';
                }
            }
        } 
    }
    return $subDetail;
}
?>
<script type="text/javascript">
    $(function(){
        $('.select2drop').select2();

        $(".fieldDate1edi").datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });
</script>