<?php

use app\helpers\App;
use app\models\search\LibrarySearch;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\Ip */

$this->title = 'Trip #: ' . '00001';
$this->params['breadcrumbs'][] = ['label' => 'Patrol History', 'url' => ['patrol-history/index']];
$this->params['breadcrumbs'][] = '00001';
$this->params['searchModel'] = new LibrarySearch(['searchLabel' => 'Patrol History']);
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false; 
?>
<div class="ip-view-page">
    <div class="row">
        <div class="col-md-7">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map Trail',
                'stretch' => true
            ]) ?>
                <img src="<?= App::baseUrl('default/tests/trail.png') ?>" class="img-fluid symbol">
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-5">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php',[
                'title' => 'Patroller',
                'stretch' => true
            ]) ?>
                <div class="">
               
                    <!--begin::User-->
                    <div class="d-flex align-items-end py-2">
                        <!--begin::Pic-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="d-flex flex-shrink-0 mr-5">
                                <div class="symbol symbol-circle symbol-lg-75">
                                    <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png" alt="image">
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Title-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">Juan Dela Cruz</a>
                                <span class="text-muted font-weight-bold">Patroller ID: 0000201</span>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::User-->
                    <!--begin::Desc-->
                    <p class="py-2">
                        A total of 50 endangered plants was encountered, 25 of them was located near the river of umiray watershed.
                    </p>
                    <!--end::Desc-->
                    <!--begin::Contacts-->
                    <div class="py-2">
                        <div class="d-flex align-items-center mb-2">
                            <span class="flex-shrink-0 mr-2">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Active-call.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
                                        <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="text-muted font-weight-bold">Date: 01/20/2022</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="flex-shrink-0 mr-2">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" fill="#000000"/>
                                        </g>
                                    </svg>

                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <a href="#" class="text-muted text-hover-primary font-weight-bold">Encoded Data: + 250 </a>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="flex-shrink-0 mr-2">

                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                Distance: 500(km) 
                            </a>
                        </div>
                    </div>
                    <!--end::Contacts-->
                    <!--begin::Actions-->
                    <div class="pt-2">
                        <!-- <a href="#" class="btn btn-primary font-weight-bolder mr-2">Contact</a> -->
                        <a href="#" class="btn btn-light-primary font-weight-bolder">Patroller Profile</a>
                    </div>
                    <!--end::Actions-->
                </div>
            <?php $this->endContent() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Encoded Trees'
            ]) ?>
                <div class="table-responsive">
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
                                    <a href="/library?sort=photo" data-sort="photo">Photo</a>
                                </th>
                                <th class="table-th" data-key="photo">
                                    <a href="/library?sort=photo" data-sort="photo">TREE ID</a>
                                </th>
                                <th class="table-th" data-key="family">
                                    <a href="/library?sort=family" data-sort="family">Family</a>
                                </th>
                                <th class="table-th" data-key="genus">
                                    <a href="/library?sort=genus" data-sort="genus">Genus</a>
                                </th>
                                <th class="table-th" data-key="species">
                                    <a href="/library?sort=species" data-sort="species">Species</a>
                                </th>
                                <th class="table-th" style="display:none" data-key="sub_species">
                                    <a href="/library?sort=sub_species" data-sort="sub_species">Sub Species</a>
                                </th>
                                <th class="table-th" style="display:none" data-key="varieta_and_infra_var_name">
                                    <a href="/library?sort=varieta_and_infra_var_name" data-sort="varieta_and_infra_var_name">Varieta And Infra Var Name</a>
                                </th>
                                <th class="table-th" data-key="common_name">
                                    <a href="/library?sort=common_name" data-sort="common_name">Common Name</a>
                                </th>
                                <th class="table-th" data-key="taxonomic_group">
                                    <a href="/library?sort=taxonomic_group" data-sort="taxonomic_group">Taxonomic Group</a>
                                </th>
                               
                                <th class="table-th" style="display:none" data-key="distribution">
                                    <a href="/library?sort=distribution" data-sort="distribution">Distribution</a>
                                </th>
                                <th class="table-th" data-key="created_at">
                                    <a class="desc" href="/library?sort=created_at" data-sort="created_at">DATE & TIME</a>
                                </th>
                                <th class="table-th" style="display:none" data-key="last_updated">
                                    <a href="/library?sort=updated_at" data-sort="updated_at">last updated</a>
                                </th>
                               
                                <th class="text-center">
                                    <span style="color:#3699FF">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-key="1">
                                <td class="table-td" data-key="serial">1</td>
                                <td class="table-td" data-key="checkbox">
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                                        <input type="checkbox" name="selection[]" value="1">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="table-td" data-key="photo">
                                    <img class="img-fluid symbol mw-50" src="/assets/images/f2/f249e7_acidula-J.R.Forst.-G.Forst..jpg-ftSsrLhiMu-1670221230.jpeg" alt="">
                                </td>
                                <td class="table-td" data-key="family">
                                    <a href="http://gennakar.local/library/1">00001</a>
                                </td>
                                <td class="table-td" data-key="family">
                                    Cyatheaceae
                                </td>
                                <td class="table-td" data-key="genus">Cyathea</td>
                                <td class="table-td" data-key="species">curranii Copel.</td>
                                <td class="table-td" style="display:none" data-key="sub_species"></td>
                                <td class="table-td" style="display:none" data-key="varieta_and_infra_var_name"></td>
                                <td class="table-td" data-key="common_name"></td>
                                <td class="table-td" data-key="taxonomic_group">Pteridophyte </td>
                                <td class="table-td" style="display:none" data-key="distribution">LUZON: Quezon. </td>
                                <td class="table-td" data-key="created_at">December 05, 2022 06:37:00 PM</td>
                                <td class="table-td" style="display:none" data-key="last_updated">18 hours ago</td>
                               
                                <td class="text-center" width="70">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
                                        <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span> Manage </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/1" title="View">
                                                        <i class="far fa-dot-circle text-info"></i>
                                                        <span class="navi-text"> &nbsp; View</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/update/1" title="Edit">
                                                        <i class="far fa-edit text-warning"></i>
                                                        <span class="navi-text"> &nbsp; Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/duplicate/1" title="Duplicate">
                                                        <i class="far fa-copy text-default"></i>
                                                        <span class="navi-text"> &nbsp; Duplicate</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link delete" href="http://gennakar.local/library/delete/1" title="Delete" data-method="post" data-confirm="Delete ?">
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                        <span class="navi-text"> &nbsp; Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-key="2">
                                <td class="table-td" data-key="serial">2</td>
                                <td class="table-td" data-key="checkbox">
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                                        <input type="checkbox" name="selection[]" value="2">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="table-td" data-key="photo">
                                    <img class="img-fluid symbol mw-50" src="/assets/images/8f/8f1e8e_bulusanicum-Holttum-Holttum.jpg-6TxCu4WxoD-1670228552.jpeg" alt="">
                                </td>
                                <td class="table-td" data-key="family">
                                    <a href="http://gennakar.local/library/1">00002</a>
                                </td>
                                <td class="table-td" data-key="family">
                                    Dipterocarpaceae
                                </td>
                                <td class="table-td" data-key="genus">Hopea</td>
                                <td class="table-td" data-key="species">malibato Foxw.</td>
                                <td class="table-td" style="display:none" data-key="sub_species"></td>
                                <td class="table-td" style="display:none" data-key="varieta_and_infra_var_name"></td>
                                <td class="table-td" data-key="common_name">Yakal-kaliot</td>
                                <td class="table-td" data-key="taxonomic_group">Angiosperm (Tree)</td>
                                <td class="table-td" style="display:none" data-key="distribution">LUZON: Quezon, NEGROS, MINDANAO: Agusan del Norte. Primary evergreen dipterocarp forests in aseasonal areas. Ascending up to 600m.</td>
                                <td class="table-td" data-key="created_at">December 05, 2022 06:37:00 PM</td>
                                <td class="table-td" style="display:none" data-key="last_updated">16 hours ago</td>
                              
                                <td class="text-center" width="70">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
                                        <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span> Manage </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/2" title="View">
                                                        <i class="far fa-dot-circle text-info"></i>
                                                        <span class="navi-text"> &nbsp; View</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/update/2" title="Edit">
                                                        <i class="far fa-edit text-warning"></i>
                                                        <span class="navi-text"> &nbsp; Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/duplicate/2" title="Duplicate">
                                                        <i class="far fa-copy text-default"></i>
                                                        <span class="navi-text"> &nbsp; Duplicate</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link delete" href="http://gennakar.local/library/delete/2" title="Delete" data-method="post" data-confirm="Delete ?">
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                        <span class="navi-text"> &nbsp; Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-key="3">
                                <td class="table-td" data-key="serial">3</td>
                                <td class="table-td" data-key="checkbox">
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                                        <input type="checkbox" name="selection[]" value="3">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="table-td" data-key="photo">
                                    <img class="img-fluid symbol mw-50" src="/assets/images/90/901b27_default-image_200.png" alt="">
                                </td>
                                <td class="table-td" data-key="family">
                                    <a href="http://gennakar.local/library/1">00003</a>
                                </td>
                                <td class="table-td" data-key="family">
                                    Dipterocarpaceae
                                </td>
                                <td class="table-td" data-key="genus">Hopea</td>
                                <td class="table-td" data-key="species">philippinensis Dyer</td>
                                <td class="table-td" style="display:none" data-key="sub_species"></td>
                                <td class="table-td" style="display:none" data-key="varieta_and_infra_var_name"></td>
                                <td class="table-td" data-key="common_name">Gisok-gisok</td>
                                <td class="table-td" data-key="taxonomic_group">Angiosperm (Tree)</td>
                                <td class="table-td" style="display:none" data-key="distribution">LUZON: Laguna, Quezon, Camarines, Albay, SAMAR, BILIRAN, LEYTE, PANAY, NEGROS, SAMAR, MINDANAO: Zamboanga, Lanao, Agusan. Primary evergreen forests on hills in aseasonal areas, ascending to 500m, often common.&nbsp;</td>
                                <td class="table-td" data-key="created_at">December 05, 2022 06:37:00 PM</td>
                                <td class="table-td" style="display:none" data-key="last_updated">14 hours ago</td>
                                <td class="text-center" width="70">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
                                        <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span> Manage </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/3" title="View">
                                                        <i class="far fa-dot-circle text-info"></i>
                                                        <span class="navi-text"> &nbsp; View</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/update/3" title="Edit">
                                                        <i class="far fa-edit text-warning"></i>
                                                        <span class="navi-text"> &nbsp; Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/duplicate/3" title="Duplicate">
                                                        <i class="far fa-copy text-default"></i>
                                                        <span class="navi-text"> &nbsp; Duplicate</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link delete" href="http://gennakar.local/library/delete/3" title="Delete" data-method="post" data-confirm="Delete ?">
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                        <span class="navi-text"> &nbsp; Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-key="4">
                                <td class="table-td" data-key="serial">4</td>
                                <td class="table-td" data-key="checkbox">
                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                                        <input type="checkbox" name="selection[]" value="4">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="table-td" data-key="photo">
                                    <img class="img-fluid symbol mw-50" src="/assets/images/90/901b27_default-image_200.png" alt="">
                                </td>
                                <td class="table-td" data-key="family">
                                    <a href="http://gennakar.local/library/1">00004</a>
                                </td>
                                <td class="table-td" data-key="family">
                                    Dipterocarpaceae
                                </td>
                                <td class="table-td" data-key="genus">Shorea</td>
                                <td class="table-td" data-key="species">astylosa Foxw.</td>
                                <td class="table-td" style="display:none" data-key="sub_species"></td>
                                <td class="table-td" style="display:none" data-key="varieta_and_infra_var_name"></td>
                                <td class="table-td" data-key="common_name">Yakal</td>
                                <td class="table-td" data-key="taxonomic_group">Angiosperm (Tree)</td>
                                <td class="table-td" style="display:none" data-key="distribution">&nbsp;LUZON: Quezon, Camarines, NEGROS, BILIRAN, SAMAR, MINDANAO: Zamboanga, Davao, Agusan. Local in primary lowland evergreen dipterocarp forests.</td>
                                <td class="table-td" data-key="created_at">December 05, 2022 06:37:00 PM</td>
                                <td class="table-td" style="display:none" data-key="last_updated">14 hours ago</td>
                              
                                <td class="text-center" width="70">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="">
                                        <a href="#" class="btn btn-fixed-height btn-bg-white btn-text-dark-50 btn-hover-text-primary btn-icon-primary font-weight-bolder font-size-sm  mr-3 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc;">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span> Manage </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0 m-0">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/4" title="View">
                                                        <i class="far fa-dot-circle text-info"></i>
                                                        <span class="navi-text"> &nbsp; View</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/update/4" title="Edit">
                                                        <i class="far fa-edit text-warning"></i>
                                                        <span class="navi-text"> &nbsp; Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link" href="http://gennakar.local/library/duplicate/4" title="Duplicate">
                                                        <i class="far fa-copy text-default"></i>
                                                        <span class="navi-text"> &nbsp; Duplicate</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a class="navi-link delete" href="http://gennakar.local/library/delete/4" title="Delete" data-method="post" data-confirm="Delete ?">
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                        <span class="navi-text"> &nbsp; Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>