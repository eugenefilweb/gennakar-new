<?php

use app\helpers\Html;
use app\helpers\App;
use app\models\File;
use app\widgets\FileExplorer;

/* @var $this yii\web\View */
/* @var $model app\models\File */

$this->title = 'Toolkit Guide';
$this->params['breadcrumbs'][] = 'Documents';
$this->params['searchModel'] = $searchModel;
$this->params['showCreateButton'] = true; 
$this->params['searchKeywordUrl'] = ['file/find-by-keywords', 'tag' => 'Toolkit Guide'];
?>


<p class="lead font-weight-bolder">
    Total: <?= File::totalSize(['tag' => 'Toolkit Guide']) ?>
    <?= Html::if(App::queryParams('keywords') != null, Html::a('Clear Filter', ['toolkit-guide/index'], [
        'class' => 'btn btn-secondary btn-sm font-weight-bold ml-2'
    ])) ?>
</p>

<?php if ($dataProvider->totalCount > 0 && App::queryParams('keywords') != null): ?>
    <?php $this->beginContent('@app/views/file/_row-header.php'); ?>
        <?= Html::foreach($dataProvider->models, function($file) {
            return $this->render('/file/_row', ['model' => $file]);
        }) ?>
    <?php $this->endContent(); ?>
<?php else: ?>
    <?= FileExplorer::widget([
        'tag' => 'Toolkit Guide',
        'breadcrumbs' => [
            [
                'folderName' => 'Documents',
                'folderPath' => 'Toolkit Guide'
            ]
        ],
        'reloadUrl' => ['toolkit-guide/index']
    ]) ?>
<?php endif ?>