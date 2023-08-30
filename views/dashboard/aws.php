<?php

use app\helpers\App;
use app\widgets\LatestEvents;
use app\widgets\TwitterPost;

$this->title = 'AWS';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/dashboard/aws';
$this->params['wrapCard'] = false;
?>

<div class="dashboard-page" style="background: url('<?= App::baseUrl('default/tests/aws.png'); ?>');background-size: cover;height: 700px">
	<br><br><br><br><br><br><br>
	<div class="text-center" style="">
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
