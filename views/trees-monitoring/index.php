<?php

use app\models\search\DashboardSearch;

$this->title = 'Trees Monitoring';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/trees-monitoring';
$this->params['wrapCard'] = false;

?>

<div class="dashboard-page">
	<div class="card card-custom  gutter-b ">
	
    <div class="card-body">
		        <div data-widget_id="w24" class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="top" data-original-title="" style="float: right;margin-right: -8px;"> 
    <a href="#!" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm _filter_columns" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;" data-toggle="dropdown">
        <span class="svg-icon svg-icon-md">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
        Filter Columns    </a>
    <div data-widget_id="w24" class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <form class="app-scroll" action="/user-meta/filter" method="post" style="max-height: 56vh; overflow: auto;">
<input type="hidden" name="_csrf" value="Nz_kxGzJx5HK4c4hUXdUv36AbAuYyxIm_2S7R-T0XExaVtW8WuS-1Kaqgm4ALRbeEecrY8C-SEyRHpYxsr9rBQ==">            <input type="hidden" id="usermeta-table_name" name="UserMeta[table_name]" value="transactions">            <ul class="navi navi-hover" style="padding: 10px;">
                <li class="navi-item"> 
                    <div class="checkbox-list ">
                        <label class="checkbox ">
                            <input type="checkbox" class="check-all-filter">
                            <span></span>
                            CHECK ALL
                        </label>
                    </div>
                    <hr>
                </li>
                <li class="navi-item">
                    <div class="checkbox-list">
                        <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="serial" checked="" data-key="serial">
                                <span></span>
                                SERIAL
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="checkbox" checked="" data-key="checkbox">
                                <span></span>
                                CHECKBOX
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="member_name" checked="" data-key="member_name">
                                <span></span>
                                MEMBER NAME
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="transaction_type" checked="" data-key="transaction_type">
                                <span></span>
                                TRANSACTION TYPE
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="status" checked="" data-key="status">
                                <span></span>
                                STATUS
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="created_at" checked="" data-key="created_at">
                                <span></span>
                                CREATED AT
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="last_updated" checked="" data-key="last_updated">
                                <span></span>
                                LAST UPDATED
                            </label>                    </div>
                </li>
            </ul>
        </form> 
        <!--end::Navigation-->
    </div>
</div>        <form action="/transaction/bulk-action" method="post">
<input type="hidden" name="_csrf" value="Nz_kxGzJx5HK4c4hUXdUv36AbAuYyxIm_2S7R-T0XExaVtW8WuS-1Kaqgm4ALRbeEecrY8C-SEyRHpYxsr9rBQ==">            <div class="d-flex">
                <div>
                    <input type="text" name="process-selected" class="app-hidden">
<div class="dropdown mb-5" style="width: fit-content;">
    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
        <span class="bulk-action-label">Bulk Action</span>
        <span class="caret"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="width: max-content;">
        <ul class="navi navi-hover">
            <li class="navi-header pb-1">
                <span class="text-primary text-uppercase font-weight-bolder font-size-sm">
                    PROCESS:
                </span>
            </li>
            <li class="navi-item">
    <a href="#" class="navi-link bulk-action" data-process="active">
        <i class="far fa-eye text-success"></i>        &nbsp;
        <span class="navi-text">
            Set as Active        </span>
    </a>
</li> <li class="navi-item">
    <a href="#" class="navi-link bulk-action" data-process="in_active">
        <i class="far fa-eye-slash text-warning"></i>        &nbsp;
        <span class="navi-text">
            Set as In-active        </span>
    </a>
</li> <li class="navi-item">
    <a href="#" class="navi-link bulk-action" data-process="delete">
        <i class="far fa-trash-alt text-danger"></i>        &nbsp;
        <span class="navi-text">
            Delete        </span>
    </a>
</li>        </ul>
    </div>
</div>                 </div>
                
            </div>
            
            <div id="w30" class="table-responsive"><div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap">
        <div class="mr-2">
            <div class="summary">Showing <b>1-12</b> of <b>12</b> items.</div>
        </div>
            </div>
    <div class="">
        
    </div>
</div>
<div class="my-2">
    <table class="table table-striped table-bordered"><thead>
<tr><th class="table-th" data-key="serial">#</th><th class="table-th" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" class="select-on-check-all" name="selection_all" value="1">    <span></span>
</label></th><th class="table-th" data-key="member_name"><a href="/transaction?sort=memberFullname" data-sort="memberFullname">TID</a></th><th class="table-th" data-key="member_name"><a href="/transaction?sort=memberFullname" data-sort="memberFullname">Name</a></th><th class="table-th" data-key="transaction_type"><a href="/transaction?sort=transaction_type" data-sort="transaction_type">order</a></th><th class="table-th" data-key="transaction_type"><a href="/transaction?sort=transaction_type" data-sort="transaction_type">family</a></th><th class="table-th" data-key="transaction_type"><a href="/transaction?sort=transaction_type" data-sort="transaction_type">Genus</a></th><th class="table-th" data-key="transaction_type"><a href="/transaction?sort=transaction_type" data-sort="transaction_type">Species</a></th><th class="table-th" data-key="transaction_type"><a href="/transaction?sort=transaction_type" data-sort="transaction_type">watershed</a></th><th class="table-th" data-key="transaction_type"><a href="/transaction?sort=transaction_type" data-sort="transaction_type">corrdinates</a></th><th class="table-th" data-key="status"><a href="/transaction?sort=status" data-sort="status">Status</a></th><th class="table-th" data-key="created_at"><a class="desc" href="/transaction?sort=created_at" data-sort="created_at">Created At</a></th><th class="table-th" data-key="last_updated"><a href="/transaction?sort=updated_at" data-sort="updated_at">last updated</a></th><th class="text-center"><span style="color:#3699FF">Actions</span></th></tr>
</thead>
<tbody>
<tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10001</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing">Damage</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10002</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-success">Healthy</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10003</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing">Damage</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10004</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing" style="
    background-color: #1BC5BD !important;
    border-color: #1BC5BD !important;
">Healthy</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10005</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing" style="
    background-color: #1BC5BD !important;
    border-color: #1BC5BD !important;
">Healthy</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10006</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing">Damage</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10007</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing">Damage</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10008</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing">Damage</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr><tr data-key="12"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="12">    <span></span>
</label></td><td class="table-td" data-key="member_name"><a href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158">10009</a></td><td class="table-td" data-key="member_name">NARRA</td><td class="table-td" data-key="transaction_type">Fabales</td><td class="table-td" data-key="transaction_type">Fabaceae</td><td class="table-td" data-key="transaction_type">Pterocarpus</td><td class="table-td" data-key="transaction_type">P. indicus</td><td class="table-td" data-key="transaction_type">kaliwa</td><td class="table-td" data-key="transaction_type">(23.43, 55.34)</td><td class="table-td" data-key="status"><label class="badge badge-warning status-mswdo-head-processing" style="
    background-color: #1BC5BD !important;
    border-color: #1BC5BD !important;
">Healthy</label><br></td><td class="table-td" data-key="created_at">July 15, 2022 11:02:38 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
    <span class="svg-icon svg-icon-md">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon-->
    </span>
	Manage
	</a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
            <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/view?token=JIW9pwRi8Y-1657854158" title="View"><i class="far fa-dot-circle text-info"></i><span class="navi-text"> &nbsp; View</span></a></li> <li class="navi-item"><a class="navi-link" href="https://gennakar.accessgov.ph/transaction/update?token=JIW9pwRi8Y-1657854158&amp;type=emergency-welfare-program" title="Edit"><i class="far fa-edit text-warning"></i><span class="navi-text"> &nbsp; Edit</span></a></li> <li class="navi-item"></li>        </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>











</tbody></table>
</div>
<div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap">
        <div class="mr-2">
            <div class="summary">Showing <b>1-12</b> of <b>12</b> items.</div>
        </div>
    </div>
    <div class="">
        
    </div>
</div>
</div>        </form> 
     
	</div>
</div>
</div>

