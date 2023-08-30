<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scholarship Management';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = true; 
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/dashboard/scholarship-management-list';
$this->params['wrapCard'] = false;
?>
<div class="card card-custom  gutter-b ">
    
    <div class="card-body">
            <div class="member-index-page">
    <div data-widget_id="w19" class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="top" data-original-title="" style="float: right;margin-right: -8px;"> 
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
    <div data-widget_id="w19" class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
        <!--begin::Navigation-->
        <form class="app-scroll" action="/gennakar/web/user-meta/filter" method="post" style="max-height: 56vh; overflow: auto;">
<input type="hidden" name="_csrf" value="YdW3UyNVhM9roLFE1RRgNuzNN3xfFE6biTh_9PE5SGFTh-QxdxnBqzzo_3OFcgtemolWNhVeCq_iVy2CmEE5NA==">            <input type="hidden" id="usermeta-table_name" name="UserMeta[table_name]" value="members">            <ul class="navi navi-hover" style="padding: 10px;">
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
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="photo" checked="" data-key="photo">
                                <span></span>
                                PHOTO
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="qr_id" checked="" data-key="qr_id">
                                <span></span>
                                QR ID
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="household_no" checked="" data-key="household_no">
                                <span></span>
                                HOUSEHOLD NO
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="last_name" checked="" data-key="last_name">
                                <span></span>
                                LAST NAME
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="middle_name" checked="" data-key="middle_name">
                                <span></span>
                                MIDDLE NAME
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="first_name" checked="" data-key="first_name">
                                <span></span>
                                FIRST NAME
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="sex" checked="" data-key="sex">
                                <span></span>
                                SEX
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="birth_date" checked="" data-key="birth_date">
                                <span></span>
                                BIRTH DATE
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="created_at" checked="" data-key="created_at">
                                <span></span>
                                CREATED AT
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="last_updated" checked="" data-key="last_updated">
                                <span></span>
                                LAST UPDATED
                            </label> <label class="checkbox">
                                <input type="checkbox" id="usermeta-columns" class="_filter_column_checkbox" name="UserMeta[columns][]" value="status" checked="" data-key="status">
                                <span></span>
                                STATUS
                            </label>                    </div>
                </li>
            </ul>
        </form> 
        <!--end::Navigation-->
    </div>
</div>    <form action="/gennakar/web/dashboard/bulk-action" method="post">
<input type="hidden" name="_csrf" value="YdW3UyNVhM9roLFE1RRgNuzNN3xfFE6biTh_9PE5SGFTh-QxdxnBqzzo_3OFcgtemolWNhVeCq_iVy2CmEE5NA==">                        
        <div id="w22" class="table-responsive"><div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap">
        <div class="mr-2">
            <div class="summary">Showing <b>1-25</b> of <b>25</b> items.</div>
        </div>
        <div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Show: 25    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?pagination=25">25</a> <a class="dropdown-item" href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?pagination=50">50</a> <a class="dropdown-item" href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?pagination=75">75</a> <a class="dropdown-item" href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?pagination=100">100</a>    </div>
</div>    </div>
    
</div>
<div class="my-2">
    <table class="table table-striped table-bordered"><thead>
<tr><th class="table-th" data-key="serial">#</th><th class="table-th" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" class="select-on-check-all" name="selection_all" value="1">    <span></span>
</label></th><th class="table-th" data-key="photo"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=photo" data-sort="photo">Photo</a></th><th class="table-th" data-key="household_no"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=householdNo" data-sort="householdNo">Household No</a></th><th class="table-th" data-key="last_name"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=last_name" data-sort="last_name">Last Name</a></th><th class="table-th" data-key="middle_name"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=middle_name" data-sort="middle_name">Middle Name</a></th><th class="table-th" data-key="first_name"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=first_name" data-sort="first_name">First Name</a></th><th class="table-th" data-key="sex"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=sex" data-sort="sex">Sex</a></th><th class="table-th" data-key="birth_date"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=birth_date" data-sort="birth_date">Birth Date</a></th><th class="table-th" data-key="created_at"><a class="desc" href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=created_at" data-sort="created_at">Created At</a></th><th class="table-th" data-key="last_updated"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=updated_at" data-sort="updated_at">last updated</a></th><th class="table-th" data-key="status"><a href="<?= \app\helpers\Url::to(['dashboard/scholarship-management-list']) ?>?sort=record_status" data-sort="record_status">status</a></th><th class="text-center"><span style="color:#3699FF">Actions</span></th></tr>
</thead>
<tbody>
<tr data-key="30001"><td class="table-td" data-key="serial">1</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30001">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151223</td><td class="table-td" data-key="last_name">MANLUGON</td><td class="table-td" data-key="middle_name">ESTEVEZ</td><td class="table-td" data-key="first_name">ANNE MARIE</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">08/05/2007</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w42">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30001" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30002"><td class="table-td" data-key="serial">2</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30002">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151223</td><td class="table-td" data-key="last_name">MANLUGON</td><td class="table-td" data-key="middle_name">ESTEVEZ</td><td class="table-td" data-key="first_name">ANTONIO</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">07/27/2010</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w47">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30002" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30003"><td class="table-td" data-key="serial">3</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30003">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151224</td><td class="table-td" data-key="last_name">ALBERTO</td><td class="table-td" data-key="middle_name">MALAGAYO</td><td class="table-td" data-key="first_name">HERSON</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">11/27/1972</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w52">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30003" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30004"><td class="table-td" data-key="serial">4</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30004">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151224</td><td class="table-td" data-key="last_name">ALBERTO</td><td class="table-td" data-key="middle_name">BERNABE</td><td class="table-td" data-key="first_name">JOCELYN</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">07/29/1972</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w57">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30004" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30005"><td class="table-td" data-key="serial">5</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30005">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151224</td><td class="table-td" data-key="last_name">ALBERTO</td><td class="table-td" data-key="middle_name">BERNABE</td><td class="table-td" data-key="first_name">JEROME</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">07/27/2001</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w62">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30005" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30006"><td class="table-td" data-key="serial">6</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30006">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151224</td><td class="table-td" data-key="last_name">SALVADOR</td><td class="table-td" data-key="middle_name">BERNABE</td><td class="table-td" data-key="first_name">BENVENITO</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">07/29/1967</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w67">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30006" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30007"><td class="table-td" data-key="serial">7</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30007">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151225</td><td class="table-td" data-key="last_name">ATENDIDO</td><td class="table-td" data-key="middle_name">CORONACION</td><td class="table-td" data-key="first_name">NANCY</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">09/26/1937</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w72">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30007" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30008"><td class="table-td" data-key="serial">8</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30008">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151226</td><td class="table-td" data-key="last_name">ATENDIDO</td><td class="table-td" data-key="middle_name">DE GUZMAN</td><td class="table-td" data-key="first_name">LAZARO III</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">12/17/1983</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w77">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30008" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30009"><td class="table-td" data-key="serial">9</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30009">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151226</td><td class="table-td" data-key="last_name">ATENDIDO</td><td class="table-td" data-key="middle_name">BUENCAMENO</td><td class="table-td" data-key="first_name">MARGIE</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">08/17/1984</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w82">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30009" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30010"><td class="table-td" data-key="serial">10</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30010">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151226</td><td class="table-td" data-key="last_name">ATENDIDO</td><td class="table-td" data-key="middle_name">BUENCAMENO</td><td class="table-td" data-key="first_name">LARRA</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">05/07/2005</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w87">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30010" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30011"><td class="table-td" data-key="serial">11</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30011">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151227</td><td class="table-td" data-key="last_name">DURANO</td><td class="table-td" data-key="middle_name">SAYNES</td><td class="table-td" data-key="first_name">CLAIRE ANN</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">05/13/1990</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w92">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30011" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30012"><td class="table-td" data-key="serial">12</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30012">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151228</td><td class="table-td" data-key="last_name">BALEN</td><td class="table-td" data-key="middle_name">ABIERA</td><td class="table-td" data-key="first_name">ROSE MARIE</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">04/14/1991</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w97">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30012" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30013"><td class="table-td" data-key="serial">13</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30013">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151229</td><td class="table-td" data-key="last_name">CLEMENTE</td><td class="table-td" data-key="middle_name">TORRES</td><td class="table-td" data-key="first_name">MANNY</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">05/22/1980</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w102">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30013" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30014"><td class="table-td" data-key="serial">14</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30014">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151230</td><td class="table-td" data-key="last_name">CALZADO</td><td class="table-td" data-key="middle_name">ALMEDA</td><td class="table-td" data-key="first_name">JAYSON</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">12/25/1975</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w107">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30014" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30015"><td class="table-td" data-key="serial">15</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30015">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151230</td><td class="table-td" data-key="last_name">CALZADO</td><td class="table-td" data-key="middle_name">SOLLESTRE</td><td class="table-td" data-key="first_name">MARIAN</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">07/11/1973</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w112">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30015" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30016"><td class="table-td" data-key="serial">16</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30016">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151230</td><td class="table-td" data-key="last_name">CALZADO</td><td class="table-td" data-key="middle_name">SOLLESTRE</td><td class="table-td" data-key="first_name">JAYSON RIAN</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">08/24/1998</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w117">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30016" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30017"><td class="table-td" data-key="serial">17</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30017">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151230</td><td class="table-td" data-key="last_name">CALZADO</td><td class="table-td" data-key="middle_name">SOLLESTRE</td><td class="table-td" data-key="first_name">JAYSON JR.</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">07/06/2001</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w122">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30017" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30018"><td class="table-td" data-key="serial">18</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30018">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151231</td><td class="table-td" data-key="last_name">RUIDERA</td><td class="table-td" data-key="middle_name">CORONACION</td><td class="table-td" data-key="first_name">CHARLO</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">03/26/1974</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w127">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30018" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30019"><td class="table-td" data-key="serial">19</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30019">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151231</td><td class="table-td" data-key="last_name">RUZOL</td><td class="table-td" data-key="middle_name">TROPICALES</td><td class="table-td" data-key="first_name">WINDA</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">03/04/1970</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w132">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30019" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30020"><td class="table-td" data-key="serial">20</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30020">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151231</td><td class="table-td" data-key="last_name">RUIDERA</td><td class="table-td" data-key="middle_name">RUZOL</td><td class="table-td" data-key="first_name">KENNET</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">03/11/1999</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w137">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30020" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30021"><td class="table-td" data-key="serial">21</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30021">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151231</td><td class="table-td" data-key="last_name">RUIDERA</td><td class="table-td" data-key="middle_name">RUZOL</td><td class="table-td" data-key="first_name">JHON CARL</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">08/04/2006</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w142">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30021" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30022"><td class="table-td" data-key="serial">22</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30022">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151231</td><td class="table-td" data-key="last_name">RUIDERA</td><td class="table-td" data-key="middle_name">RUZOL</td><td class="table-td" data-key="first_name">JOSSA MAE</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">08/31/2008</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w147">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30022" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30023"><td class="table-td" data-key="serial">23</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30023">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151232</td><td class="table-td" data-key="last_name">ESTEVES</td><td class="table-td" data-key="middle_name">MERCADO</td><td class="table-td" data-key="first_name">ERL JULIUS</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">05/07/1990</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w152">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30023" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30024"><td class="table-td" data-key="serial">24</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30024">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151232</td><td class="table-td" data-key="last_name">COBALLES</td><td class="table-td" data-key="middle_name">BUEGIS</td><td class="table-td" data-key="first_name">REGELYN</td><td class="table-td" data-key="sex">Female</td><td class="table-td" data-key="birth_date">04/10/1990</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w157">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30024" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
<tr data-key="30025"><td class="table-td" data-key="serial">25</td><td class="table-td" data-key="checkbox"><label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
    <input type="checkbox" name="selection[]" value="30025">    <span></span>
</label></td><td class="table-td" data-key="photo"><div class="symbol mr-3" style="width:50px;"><img class=" mw-50" src="https://www.w3schools.com/howto/img_avatar.png" alt=""></div></td><td class="table-td" data-key="household_no">1151233</td><td class="table-td" data-key="last_name">LAMBOT</td><td class="table-td" data-key="middle_name">MERAÑA</td><td class="table-td" data-key="first_name">FELIZARDO</td><td class="table-td" data-key="sex">Male</td><td class="table-td" data-key="birth_date">12/03/1953</td><td class="table-td" data-key="created_at">September 08, 2022 08:13:15 AM</td><td class="table-td" data-key="last_updated">1 month ago</td><td class="table-td" data-key="status"><span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w162">
    <label>
        <input data-link="http://localhost/gennakar/web/member/change-record-status" data-model_id="30025" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
        <span></span>
    </label>
</span></td><td class="text-center" width="70"><div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
    <a href="<?= App::baseUrl('dashboard/scholarship-management') ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
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
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
        <!--begin::Navigation-->
        <ul class="navi navi-hover">
                    </ul>
        <!--end::Navigation-->
    </div>
</div></td></tr>
</tbody></table>
</div>
<div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap">
        <div class="mr-2">
            <div class="summary">Showing <b>1-25</b> of <b>25</b> items.</div>
        </div>
    </div>
    <div class="">
        
    </div>
</div>
</div>    </form> 
</div> 
    </div>
</div>