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
                <span>List User</span>
            </li>
            <li class="pull-right">
                <a href="<?php echo base_url('create-user'); ?>" class="btn btngreen">Add User</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <table id="table_leave" class="common_datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Post</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty(@$user_list)){
                                        foreach($user_list as $userVal){
                                        if(@$userVal['isActive'] == '1'){
                                            $status = '<span class="label label-sm label-success"> Active </span>';
                                            $stBtn = '<a class="btn btngreen user_status" style="padding-right: 18px; padding-left: 17px;"
                                            data-status="0" id="'.@$userVal['id'].'" title="Click here to InActive User">InActive</a>';
                                        } else{
                                            $status = '<span class="label label-sm label-warning"> InActive </span>';
                                            $stBtn = '<a class="btn btngreen user_status" style="padding-right: 22px; padding-left: 25px;" data-status="1" id="'.@$userVal['id'].'" title="Click here to Active User">Active</a>';
                                        }

                                        if(@$userVal['user_type'] == '1'){
                                            $post = 'HR';
                                        } else{
                                            $post = 'Employee';
                                        } ?>
                                            <tr>
                                                <td><?php echo @$userVal['firstName']. " " .@$userVal['lastName']; ?></td>
                                                <td><?php echo @$userVal['email']; ?></td>
                                                <td><?php echo @$post; ?></td>
                                                <td><?php echo @$status; ?></td>
                                                <td>
                                                    <?php echo $stBtn; ?>
                                                    <a href="<?php echo base_url('edit-user/'.@$userVal['id']); ?>" class="btn btngreen icon_btn" title="View User"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
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
            