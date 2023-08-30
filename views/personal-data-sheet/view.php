<?php

use app\helpers\Html;
use app\models\search\PersonalDataSheetSearch;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalDataSheet */

$this->title = 'Personal Data Sheet: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Personal Data Sheets', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PersonalDataSheetSearch();
$this->params['showCreateButton'] = true; 

$this->registerJs(<<< JS
    let timePassword = {$tokenModel->remaining};

    const passwordInterval = setInterval(() => {
        if (timePassword > 0 ) {
            timePassword--;
            $(document).find('.password-time').html(timePassword);
        }
    }, 1000);

    setTimeout(function() {
        clearInterval(passwordInterval);
        location.reload();
    }, timePassword * 1000);
JS);

?>
<div class="personal-data-sheet-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Html::popupCenter('Print', $model->printableUrl, [
        'class' => 'btn btn-secondary font-weight-bold',
    ]) ?>
     <div class="d-flex justify-content-center mt-5">
        <div></div>
        <div style="border: 1px solid #ccc; padding: 2rem;overflow: auto;">
            <?= $this->render('printable2', [
                'model' => $model, 
                'style' => 'width: 1024px;'
            ]) ?>
        </div>
        <div></div>
    </div>
</div>