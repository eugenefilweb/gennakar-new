<?php
use app\helpers\Html;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\EnvironmentalIncidentSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EnvironmentalIncident */

$incidents = App::params('incidents');
$incidents = $incidents?ArrayHelper::index($incidents, 'id'):[];


$this->title = 'Environmental Incident: ' . $incidents[$model->incident]['label']?:$model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Environmental Incidents', 'url' => $model->indexUrl];
//$this->params['breadcrumbs'][] = $incidents[$model->incident]['label']?:$model->mainAttribute;
$this->params['searchModel'] = new EnvironmentalIncidentSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="environmental-incident-view-page">
    
    
 
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    
    <div class="row">
        
    <div class="col-md-4">
       <?= Detail::widget(['model' => $model]) ?>
    </div>
    
    <div class="col-md-8">
   <?php 
    $photos=$model->photos?json_decode($model->photos):[];
    
   //print_r($photos);
   if($photos){
       echo '<div class="row mt-5">';
       foreach($photos as $key=>$row){
           echo '<div class="col-sm-6">'.Html::image($row, ['w'=>1000, 'h'=>1000], ['class'=>'test', 'style'=>"max-width: 1000px;width: 100%;"]).'</div>';  
       }
        echo '</div>';
   }
    ?>
      </div>
      
    </div>
    
</div>