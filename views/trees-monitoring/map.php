<?php

use app\models\search\DashboardSearch;
use app\widgets\Map;
use app\helpers\App;

$this->title = 'Forest Protection: Map';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/trees-monitoring/map';
$this->params['wrapCard'] = false;
?>

<div class="map-page">
	<div class="row">
		<div class="col-md-8">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body pt-7">
					<div class="dashboard-page" style="background: url('<?= App::baseUrl('default/tests/aws.png'); ?>');background-size: cover;height: 100%">
						<div class="text-center p-30" style="">
							<h2 style="color: #fff; font-weight: 600;">Pterocarpus indicus</h2>
							<div class="align-items-center d-flex justify-content-center" style="background: #fff; max-width: 35rem;margin: 0 auto; border-radius: 10px;">
								<div>
									<table class="table">
										<tbody>
											<tr> <th>Kingdom</th> <td>: Plantae</td> </tr>
											<tr> <th>Order</th> <td>: Fabales</td> </tr>
											<tr> <th>Family</th> <td>: Fabaceae</td> </tr>
											<tr> <th>Subfamily</th> <td>: Faboideae</td> </tr>
											<tr> <th>Genus</th> <td>: Pterocarpus</td> </tr>
											<tr> <th>Species</th> <td>: P. indicus</td> </tr>
										</tbody>
									</table>
								</div>
								<div>
									<img src="<?= App::baseUrl('default/tests/narra.jpg'); ?>">
								</div>
							</div>
							<div style="width: 0;
							    height: 0;
							    border-style: solid;
							    border-width: 25px 25px 0 25px;
							    border-color: #ffffff transparent transparent transparent;
							    margin: 0 auto;">
								
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-4">
			<div class="card card-custom card-stretch gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 pt-6">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Tree Summary</span>
						<span class="text-muted mt-3 font-weight-bold font-size-lg">Total 23, 432</span>
					</h3>
					<div class="card-toolbar">
						<div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
							<a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="svg-icon svg-icon-lg">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Text/Dots.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1">
											<rect x="14" y="9" width="6" height="6" rx="3" fill="black"></rect>
											<rect x="3" y="9" width="6" height="6" rx="3" fill="black" fill-opacity="0.7"></rect>
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								<!--begin::Navigation-->
								<ul class="navi navi-hover">
									<li class="navi-header pb-1">
										<span class="text-primary text-uppercase font-weight-bolder font-size-sm">Add new:</span>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="flaticon2-shopping-cart-1"></i>
											</span>
											<span class="navi-text">Order</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="flaticon2-calendar-8"></i>
											</span>
											<span class="navi-text">Event</span>
											<span class="navi-link-badge">
												<span class="label label-light-danger label-inline font-weight-bold">new</span>
											</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="flaticon2-graph-1"></i>
											</span>
											<span class="navi-text">Report</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="flaticon2-rocket-1"></i>
											</span>
											<span class="navi-text">Post</span>
											<span class="navi-link-badge">
												<span class="label label-light-success label-rounded font-weight-bolder">5</span>
											</span>
										</a>
									</li>
									<li class="navi-item">
										<a href="#" class="navi-link">
											<span class="navi-icon">
												<i class="flaticon2-writing"></i>
											</span>
											<span class="navi-text">File</span>
										</a>
									</li>
								</ul>
								<!--end::Navigation-->
							</div>
						</div>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body pt-7">
					<!--begin::Item-->
					<div class="d-flex align-items-center mb-6">
						<!--begin::Symbol-->
						<div class="symbol symbol-35 flex-shrink-0 mr-3">
							<img alt="Pic" src="https://guide2agriculture.com/wp-content/uploads/2021/09/Narra_Tree.jpeg">
						</div>
						<!--end::Symbol-->
						<!--begin::Content-->
						<div class="d-flex align-items-center flex-wrap flex-row-fluid">
							<!--begin::Text-->
							<div class="d-flex flex-column pr-5 flex-grow-1">
								<a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">Narra</a>
								<span class="text-muted font-weight-bold">Pterocarpus indicus</span>
							</div>
							<!--begin::Label-->
							<span class="text-dark-50 font-weight-bold font-size-lg py-2"><?= number_format(rand(1111, 9999)) ?></span>
							<!--end::Label-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="d-flex align-items-center mb-6">
						<!--begin::Symbol-->
						<div class="symbol symbol-35 symbol-light-info flex-shrink-0 mr-3">
							<img alt="Pic" src="https://image.shutterstock.com/image-photo/acacia-tree-zimbabwe-september-8-260nw-1089364364.jpg">
						</div>
						<!--end::Symbol-->
						<!--begin::Content-->
						<div class="d-flex align-items-center flex-wrap flex-row-fluid">
							<!--begin::Text-->
							<div class="d-flex flex-column pr-5 flex-grow-1">
								<a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">Acacia</a>
								<span class="text-muted font-weight-bold">Acacia penninervis</span>
							</div>
							<!--end::Text-->
							<!--begin::Label-->
							<span class="text-dark-50 font-weight-bold font-size-lg py-2"><?= number_format(rand(1111, 9999)) ?></span>
							<!--end::Label-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="d-flex align-items-center mb-6">
						<!--begin::Symbol-->
						<div class="symbol symbol-35 symbol-light-success flex-shrink-0 mr-3">
							<img alt="Pic" src="https://ask2.extension.org/file.php?key=03utbjk13g3imfsws0amryrkhzou8ocs&expires=1633564800&signature=6cc70518034fcc580acf6095683e00a76310ef5f">

						</div>
						<!--end::Symbol-->
						<!--begin::Content-->
						<div class="d-flex align-items-center flex-wrap flex-row-fluid">
							<!--begin::Text-->
							<div class="d-flex flex-column pr-5 flex-grow-1">
								<a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">Balsa</a>
								<span class="text-muted font-weight-bold">Ochroma</span>
							</div>
							<!--end::Text-->
							<!--begin::Label-->
							<span class="text-dark-50 font-weight-bold font-size-lg py-2"><?= number_format(rand(1111, 9999)) ?></span>
							<!--end::Label-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="d-flex align-items-center mb-6">
						<!--begin::Symbol-->
						<div class="symbol symbol-35 flex-shrink-0 mr-3">
							<img alt="Pic" src="http://cdn.shopify.com/s/files/1/0062/8532/8445/products/Cavendish_Banana_BB_600x600_939152a4-d4bf-4a5e-ac33-3c34c81cf01b_grande.jpg?v=1582839024">
						</div>
						<!--end::Symbol-->
						<!--begin::Content-->
						<div class="d-flex align-items-center flex-wrap flex-row-fluid">
							<!--begin::Text-->
							<div class="d-flex flex-column pr-5 flex-grow-1">
								<a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">Banana</a>
								<span class="text-muted font-weight-bold">Musa</span>
							</div>
							<!--end::Text-->
							<!--begin::Label-->
							<span class="text-dark-50 font-weight-bold font-size-lg py-2"><?= number_format(rand(1111, 9999)) ?></span>
							<!--end::Label-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="d-flex align-items-center mb-6">
						<!--begin::Symbol-->
						<div class="symbol symbol-35 symbol-light-danger flex-shrink-0 mr-3">
							<img alt="Pic" src="https://cdn.shopify.com/s/files/1/0059/8835/2052/products/Heritage_River_Birch_1_FGT_650x.jpg?v=1612444342">

						</div>
						<!--end::Symbol-->
						<!--begin::Content-->
						<div class="d-flex align-items-center flex-wrap flex-row-fluid">
							<!--begin::Text-->
							<div class="d-flex flex-column pr-5 flex-grow-1">
								<a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">Birch</a>
								<span class="text-muted font-weight-bold">Betula</span>
							</div>
							<!--end::Text-->
							<!--begin::Label-->
							<span class="text-dark-50 font-weight-bold font-size-lg py-2"><?= number_format(rand(1111, 9999)) ?></span>
							<!--end::Label-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
					<!--begin::Item-->
					<div class="d-flex align-items-center">
						<!--begin::Symbol-->
						<div class="symbol symbol-35 symbol-light-primary flex-shrink-0 mr-3">
							<img alt="Pic" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Arcosu07.jpg/300px-Arcosu07.jpg">
							
						</div>
						<!--end::Symbol-->
						<!--begin::Content-->
						<div class="d-flex align-items-center flex-wrap flex-row-fluid">
							<!--begin::Text-->
							<div class="d-flex flex-column pr-5 flex-grow-1">
								<a href="#" class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">Carob</a>
								<span class="text-muted font-weight-bold">Ceratonia siliqua</span>
							</div>
							<!--end::Text-->
							<!--begin::Label-->
							<span class="text-dark-50 font-weight-bold font-size-lg py-2"><?= number_format(rand(1111, 9999)) ?></span>
							<!--end::Label-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Item-->
				</div>
				<!--end::Body-->
			</div>
		</div>
	</div>
</div>

