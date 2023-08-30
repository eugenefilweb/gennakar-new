<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Activity Report';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = true; 
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/post-activity-report';
$this->params['wrapCard'] = false;
$this->params['headerButtons'] = implode('/', [
    Html::a('Create Post Activity Report', '#', [
        'onClick' => 'alert("Coming Soon")',
        'class' => 'btn btn-success font-weight-bolder'
    ])
]);
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
            </svg>
            <!--end::Svg Icon-->
          </span>
          Filter Columns    
        </a>
        <div data-widget_id="w19" class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
          <!--begin::Navigation-->
          <form class="app-scroll" action="/gennakar/web/user-meta/filter" method="post" style="max-height: 56vh; overflow: auto;">
            <input type="hidden" name="_csrf" value="_PHYonhPMUzIXQHx9czcR1-syvJtYpSU6V9o0SB6D2LOo4vALAN0KJ8VT8alqrcvKeiruCco0KCCMDqnSQJ-Nw==">            
            <input type="hidden" id="usermeta-table_name" name="UserMeta[table_name]" value="members">            
            <ul class="navi navi-hover" style="padding: 10px;">
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
                  </label>                    
                </div>
              </li>
            </ul>
          </form>
          <!--end::Navigation-->
        </div>
      </div>
      <form action="/gennakar/web/dashboard/bulk-action" method="post">
        <input type="hidden" name="_csrf" value="_PHYonhPMUzIXQHx9czcR1-syvJtYpSU6V9o0SB6D2LOo4vALAN0KJ8VT8alqrcvKeiruCco0KCCMDqnSQJ-Nw==">                        
        <div id="w22" class="table-responsive">
          <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap">
              <div class="mr-2">
                <div class="summary">Showing <b>1-25</b> of <b>25</b> items.</div>
              </div>
              <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Show: 25    
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="/gennakar/web/post-activity-report?pagination=25">25</a> <a class="dropdown-item" href="/gennakar/web/post-activity-report?pagination=50">50</a> <a class="dropdown-item" href="/gennakar/web/post-activity-report?pagination=75">75</a> <a class="dropdown-item" href="/gennakar/web/post-activity-report?pagination=100">100</a>    
                </div>
              </div>
            </div>
          </div>
          <div class="my-2">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="table-th" data-key="serial">#</th>
                  <th class="table-th" data-key="checkbox">
                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                    <input type="checkbox" class="select-on-check-all" name="selection_all" value="1">    
                    <span></span>
                    </label>
                  </th>
                  <th class="table-th" data-key="photo">
                    <a href="#" data-sort="photo">Photo</a>
                  </th>
                  <th class="table-th" data-key="household_no">
                    <a href="#" data-sort="householdNo">Report no</a>
                  </th>
                  <th class="table-th" data-key="last_name">
                    <a href="#" data-sort="last_name">activity name</a>
                  </th>
                  <th class="table-th" data-key="middle_name">
                    <a href="#" data-sort="middle_name">Descripton</a>
                  </th>
                  <th class="table-th" data-key="created_at">
                    <a class="desc" href="#" data-sort="created_at">Created At</a>
                  </th>
                  <th class="table-th" data-key="status">
                    <a href="#" data-sort="record_status">status</a>
                  </th>
                  <th class="text-center">
                    <span style="color:#3699FF">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $faker = \Faker\Factory::create(); ?>
                <?php for ($i=1; $i <= 25; $i++) : ?>
                  <?php 
                  $m = rand(1, 11);
                  $d = rand(1, 28);
                  $date = date("2022-{$m}-{$d} H:i:s A");
                  $end = date('Y-m-d H:i:s A', strtotime("{$date} +5days"));
                  $created_at = implode(' ', [$date, $faker->time]); 
                  ?>
                  <tr data-key="30001-<?= $i ?>">
                    <td class="table-td" data-key="serial"><?= $i ?></td>
                    <td class="table-td" data-key="checkbox">
                      <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                      <input type="checkbox" name="selection[]" value="30001">    
                      <span></span>
                      </label>
                    </td>
                    <td class="table-td" data-key="photo">
                      <div class="symbol mr-3" style="width:50px;">
                        <img class=" mw-50" src="data:image/png;base64,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" alt="">
                      </div>
                    </td>
                    <td class="table-td" data-key="household_no">1151223<?= $i ?></td>
                    <td class="table-td" data-key="last_name"><?= $faker->firstName ?>'s Activity Report</td>
                    <td class="table-td" data-key="middle_name"><?= $faker->realText(50) ?></td>
                    <td class="table-td" data-key="created_at"><?= $created_at ?></td>
                    <td class="table-td" data-key="status">
                      <span class="switch switch-outline switch-icon switch-sm switch-success " data-widget_id="w42">
                      <label>
                      <input data-link="#" data-model_id="30001" class="input-switcher" data-with-confirmation="true" type="checkbox" name="" checked="">
                      <span></span>
                      </label>
                      </span>
                    </td>
                    <td class="text-center" width="70">
                      <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
                        <a href="<?= \app\helpers\Url::to(['post-activity-report/view']) ?>" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" style="border: 1px solid #ccc;">
                          <span class="svg-icon svg-icon-md">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                          Manage
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0" style="">
                          <!--begin::Navigation-->
                          <ul class="navi navi-hover"></ul>
                          <!--end::Navigation-->
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
          <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap">
              <div class="mr-2">
                <div class="summary">Showing <b>1-25</b> of <b>25</b> items.</div>
              </div>
            </div>
            <div class=""></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>