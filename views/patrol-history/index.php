<?php

use app\helpers\Html;
use app\helpers\Url;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patrol History';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = true; 
$this->params['showExportButton'] = true;
?>
<div class="email-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
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
                      
                        <th class="table-th" data-key="sub_species">
                            <a href="/library?sort=sub_species" data-sort="sub_species">TRIP #</a>
                        </th>
                        <th class="table-th" data-key="varieta_and_infra_var_name">
                            <a href="/library?sort=varieta_and_infra_var_name" data-sort="varieta_and_infra_var_name">NAME</a>
                        </th>
                        <th class="table-th" data-key="conservation_status">
                            <a href="/library?sort=conservation_status" data-sort="conservation_status">WATERSHED AREA</a>
                        </th>
                      
                        <th class="table-th" data-key="created_at">
                            <a class="desc" href="/library?sort=created_at" data-sort="created_at">DATE</a>
                        </th>
                     
                        <th class="text-center">
                            <span style="color:#3699FF">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=1; $i < 20; $i++) : ?>
                        <?php
                            $faker = \Faker\Factory::create();
                            $watershed = $faker->randomElement(['Umiray', 'Kaliwa', 'Kanan']);
                        ?>
                        <tr data-key="1">
                            <td class="table-td" data-key="serial"><?= $i ?></td>
                            <td class="table-td" data-key="checkbox">
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success">
                                    <input type="checkbox" name="selection[]" value="1">
                                    <span></span>
                                </label>
                            </td>
                            <td class="table-td" data-key="photo">
                                <?= Html::tag('a', '0000' . $i, [
                                    'href' => Url::toRoute(['patrol-history/view', 'id' => 1])
                                ]) ?>
                            </td>
                            <td class="table-td" data-key="conservation_status">
                                <?= $faker->name ?>
                            </td>
                            <td class="table-td" data-key="residency_status"><?= $watershed ?> </td>
                            <td class="table-td" data-key="created_at">
                                <?= date('m/d/Y', strtotime("12/01/2022 -{$i}day")) ?>
                            </td>
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
                    <?php endfor ?>

                </tbody>
            </table>
        </div>
    <?= Html::endForm(); ?> 
</div>