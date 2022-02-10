<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?= base_url('time-adjustment-request'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>List Punch Type</span>
            </li>
            <li class="pull-right">
                <a href="<?= base_url('create-punchtype'); ?>" class="btn btngreen">Add Punch Type</a>
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
                            <table id="table_leave" class="punch_datatable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>punch Status Name</th>
                                        <th>Order By</th>
                                        <th>Status</th>
                                        <th width="22%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty(@$punch_type)){
                                        foreach($punch_type as $punch){
                                             if(@$punch['isActive'] == '1'){
                                            $status = '<span class="label label-sm label-success"> Active </span>';
                                            $stBtn = '<a class="btn btngreen punch_type_active" style="padding-right: 18px; padding-left: 17px;"
                                            data-status="0" id="'.@$punch['id'].'" title="Click here to InActive Status">InActive</a>';
                                        } else{
                                            $status = '<span class="label label-sm label-warning"> InActive </span>';
                                            $stBtn = '<a class="btn btngreen punch_type_active" style="padding-right: 22px; padding-left: 25px;" data-status="1" id="'.@$punch['id'].'" title="Click here to Active Status">Active</a>';
                                        } ?>
                                            <tr>
                                                <td><?= @$punch['id']; ?> </td>
                                                <td><?= @$punch['punch_type_name']; ?></td>
                                                <td><?= @$punch['order_by']; ?></td>
                                                <td><?= @$status; ?></td>
                                                <td>
                                                    <?= $stBtn; ?>
                                                    <a href="<?= base_url('edit-punchtype/'.@$punch['id']); ?>" class="btn btngreen icon_btn" title="View Supervisor"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                      <a class="btn btn-danger icon_btn" href="<?= base_url('delete-punchtype/'.@$punch['id']); ?>" onclick="return confirm('Are you sure you want to delete? ');" title="Delete">
                                                         <i class="fa fa-trash-o"></i> 
                                                     </a>
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
            