<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Database;
use app\widgets\DatabaseCard;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DatabaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Peoples Association Database';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/dashboard/people-association';
$this->params['headerButtons'] = Html::a('View All Records', ['database/member'], [
	'class' => 'btn btn-success font-weight-bolder'
]);
?>

<div class="database-index-page">
	<div class="row">
	
		<div class="col-md-4 mb-10">
		    <div class="card card-custom card-stretch bg-diagonal bg-diagonal-light-primary app-border database-card" data-url="/gennakar/web/database/member?priority_sector=1&amp;status=Active">
		        <div class="card-body">
		            <a href="#" class="h4 text-dark text-hover-primary">
		                Umiray            </a>
		            <div class="row my-5">
		                <div class="col-md-6 m-auto">
		                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
		                        <div>
		                            <b>Total:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=1&amp;status=Active">4,105</a>                        </div>
		                        <div>
		                            <b>Male:</b>
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=1&amp;status=Active&amp;gender=Male">1,837</a>                        </div>
		                        <div>
		                            <b>Female:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=1&amp;status=Active&amp;gender=Female">2,268</a>                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 m-auto">
		                    <a class="btn font-weight-bolder text-uppercase btn-outline-primary btn-lg float-right" href="#/gennakar/web/database/create?priority_sector=1"><i class="fa fa-plus-circle"></i> ADD RECORD</a>                </div>
		            </div>

		            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
		                <em>Last Updated: September 08, 2022</em>
		            </div>
		        </div>
		    </div>
		</div> 
		<div class="col-md-4 mb-10">
		    <div class="card card-custom card-stretch bg-diagonal bg-diagonal-light-success app-border database-card" data-url="/gennakar/web/database/member?priority_sector=2&amp;status=Active">
		        <div class="card-body">
		            <a href="#" class="h4 text-dark text-hover-success">
		                Kaliwa            </a>
		            <div class="row my-5">
		                <div class="col-md-6 m-auto">
		                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
		                        <div>
		                            <b>Total:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=2&amp;status=Active">516</a>                        </div>
		                        <div>
		                            <b>Male:</b>
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=2&amp;status=Active&amp;gender=Male">56</a>                        </div>
		                        <div>
		                            <b>Female:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=2&amp;status=Active&amp;gender=Female">460</a>                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 m-auto">
		                    <a class="btn font-weight-bolder text-uppercase btn-outline-success btn-lg float-right" href="#/gennakar/web/database/create?priority_sector=2"><i class="fa fa-plus-circle"></i> ADD RECORD</a>                </div>
		            </div>

		            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
		                <em>Last Updated: September 07, 2022</em>
		            </div>
		        </div>
		    </div>
		</div> 
		<div class="col-md-4 mb-10">
		    <div class="card card-custom card-stretch bg-diagonal bg-diagonal-light-secondary app-border database-card" data-url="/gennakar/web/database/member?priority_sector=3&amp;status=Active">
		        <div class="card-body">
		            <a href="#" class="h4 text-dark text-hover-secondary">
		                Kanan            </a>
		            <div class="row my-5">
		                <div class="col-md-6 m-auto">
		                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
		                        <div>
		                            <b>Total:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=3&amp;status=Active">216</a>                        </div>
		                        <div>
		                            <b>Male:</b>
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=3&amp;status=Active&amp;gender=Male">113</a>                        </div>
		                        <div>
		                            <b>Female:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=3&amp;status=Active&amp;gender=Female">103</a>                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 m-auto">
		                    <a class="btn font-weight-bolder text-uppercase btn-outline-secondary btn-lg float-right" href="#/gennakar/web/database/create?priority_sector=3"><i class="fa fa-plus-circle"></i> ADD RECORD</a>                </div>
		            </div>

		            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
		                <em>Last Updated: September 07, 2022</em>
		            </div>
		        </div>
		    </div>
		</div> 
		<div class="col-md-4 mb-10">
		    <div class="card card-custom card-stretch bg-diagonal bg-diagonal-light-danger app-border database-card" data-url="/gennakar/web/database/member?priority_sector=4&amp;status=Active">
		        <div class="card-body">
		            <a href="#" class="h4 text-dark text-hover-danger">
		                Indigenous Peoples            </a>
		            <div class="row my-5">
		                <div class="col-md-6 m-auto">
		                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
		                        <div>
		                            <b>Total:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=4&amp;status=Active">521</a>                        </div>
		                        <div>
		                            <b>Male:</b>
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=4&amp;status=Active&amp;gender=Male">56</a>                        </div>
		                        <div>
		                            <b>Female:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=4&amp;status=Active&amp;gender=Female">465</a>                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 m-auto">
		                    <a class="btn font-weight-bolder text-uppercase btn-outline-danger btn-lg float-right" href="#/gennakar/web/database/create?priority_sector=4"><i class="fa fa-plus-circle"></i> ADD RECORD</a>                </div>
		            </div>

		            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
		                <em>Last Updated: September 07, 2022</em>
		            </div>
		        </div>
		    </div>
		</div> 
		<div class="col-md-4 mb-10">
		    <div class="card card-custom card-stretch bg-diagonal bg-diagonal-light-warning app-border database-card" data-url="/gennakar/web/database/member?priority_sector=5&amp;status=Active">
		        <div class="card-body">
		            <a href="#" class="h4 text-dark text-hover-warning">
		                Senior Citizen            </a>
		            <div class="row my-5">
		                <div class="col-md-6 m-auto">
		                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
		                        <div>
		                            <b>Total:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=5&amp;status=Active">835</a>                        </div>
		                        <div>
		                            <b>Male:</b>
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=5&amp;status=Active&amp;gender=Male">477</a>                        </div>
		                        <div>
		                            <b>Female:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=5&amp;status=Active&amp;gender=Female">358</a>                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 m-auto">
		                    <a class="btn font-weight-bolder text-uppercase btn-outline-warning btn-lg float-right" href="#/gennakar/web/database/create?priority_sector=5"><i class="fa fa-plus-circle"></i> ADD RECORD</a>                </div>
		            </div>

		            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
		                <em>Last Updated: September 08, 2022</em>
		            </div>
		        </div>
		    </div>
		</div> 
		<div class="col-md-4 mb-10">
		    <div class="card card-custom card-stretch bg-diagonal bg-diagonal-light-info app-border database-card" data-url="/gennakar/web/database/member?priority_sector=6&amp;status=Active">
		        <div class="card-body">
		            <a href="#" class="h4 text-dark text-hover-info">
		                Scholars            </a>
		            <div class="row my-5">
		                <div class="col-md-6 m-auto">
		                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
		                        <div>
		                            <b>Total:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=6&amp;status=Active">0</a>                        </div>
		                        <div>
		                            <b>Male:</b>
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=6&amp;status=Active&amp;gender=Male">0</a>                        </div>
		                        <div>
		                            <b>Female:</b> 
		                            <a class="font-weight-bolder" href="#/gennakar/web/database/member?priority_sector=6&amp;status=Active&amp;gender=Female">0</a>                        </div>
		                    </div>
		                </div>
		                <div class="col-md-6 m-auto">
		                    <a class="btn font-weight-bolder text-uppercase btn-outline-info btn-lg float-right" href="#/gennakar/web/database/create?priority_sector=6"><i class="fa fa-plus-circle"></i> ADD RECORD</a>                </div>
		            </div>

		            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
		                <em>Last Updated: N/A</em>
		            </div>
		        </div>
		    </div>
		</div> 
</div>
</div>
