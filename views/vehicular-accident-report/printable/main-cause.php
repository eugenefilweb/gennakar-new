<?php

use app\helpers\App;
use app\helpers\Html;
?>

<div class="p-h1p2rem"></div>
<table width="100%">
    <tbody>
    	<tr>
    		<td class="text-center td-header p-bbcb" colspan="6"> Main Cause </td>
    	</tr>
    	<tr>
    		<td colspan="2">
    			<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "main_cause", '', [
                            'checked' => trim($model->main_cause) == $model->getParamMainCause(0)
                        ]) ?>
                        <span></span><?= $model->getParamMainCause(0) ?>
                    </label>
                </div>
    		</td>
    		<td>
    			<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "main_cause", '', [
                            'checked' => trim($model->main_cause) == $model->getParamMainCause(1)
                        ]) ?>
                        <span></span><?= $model->getParamMainCause(1) ?>
                    </label>
                </div>
    		</td>
    		<td colspan="2">
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "main_cause", '', [
                            'checked' => trim($model->main_cause) == $model->getParamMainCause(2)
                        ]) ?>
                        <span></span><?= $model->getParamMainCause(2) ?>
                    </label>
                </div>
    		</td>
    		<td>Others: <span class=""><?= $model->otherMainCause ?></span></td>
    	</tr>

    	<tr>
    		<td class="text-center td-header p-bbcb" colspan="6"> Number of Vehicle(s) Involved </td>
    	</tr>
    	<tr>
    		<td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][0]) ?></td>
    		<td colspan="2"><?= App::params('var')['type'][0] ?></td>
    		<td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][1]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][1] ?></td>
    	</tr>
    	<tr>
            <td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][2]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][2] ?></td>
            <td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][3]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][3] ?></td>
        </tr>
        <tr>
            <td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][4]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][4] ?></td>
            <td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][5]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][5] ?></td>
        </tr>
        <tr>
            <td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][6]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][6] ?></td>
            <td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][7]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][7] ?></td>
        </tr>
    	<tr>
    		<td class="text-center"><?= $model->getTotalVehiclesData(App::params('var')['type'][8]) ?></td>
            <td colspan="2"><?= App::params('var')['type'][8] ?></td>
    		<td class="text-center"><?= $model->otherTotalVehiclesData['total_other_vehicle'] ?></td>
    		<td colspan="2">Others: <?= $model->otherTotalVehiclesData['data'] ?></td>
    	</tr>

    	<tr>
    		<td class="bth" width="10%"></td>
    		<td class="bth brh"></td>
    		<td class="bth" width="25%"></td>
    		<td class="bth" width="10%"></td>
    		<td class="bth brh"></td>
    		<td class="bth" width="25%"></td>
    	</tr>
	</tbody>	
</table>
<p class="mt-1">Latitude: <?= $model->latitude ?> Longitude: <?= $model->longitude ?></p>
<div class="page-break"> </div>
