<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Directory;
use app\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$type = App::formatter()->asUcWords(App::get('type'));

$this->title = $type ?: 'Directories';
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['card']];
if ($type) {
    $this->params['breadcrumbs'][] = $type;
}
$this->params['searchModel'] = $searchModel; 
$this->params['headerButtons'] = '
    <div class="d-flex align-items-center">
        '. Html::a('Table View', ['directory/index', 'list' => 'table'], ['class' => 'btn btn-outline-primary font-weight-bolder mx-3']) .'
        '. Html::exportButton($this->params, true) .'
        '. Directory::createButton() .'
    </div>
';
$this->params['activeMenuLink'] = '/directory/card';
$this->params['wrapCard'] = false;

$this->registerCss(<<< CSS
    .directory-index-page .card-body {
        background: #f7f7f7;
    }
    .directory-index-page-item .card-body {
        background: #fff;
    }
CSS);
?>
<div class="directory-index-page">
   
    <?php foreach ($dataProviders as $type => $dataProvider): ?>
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
            'title' => $type
        ]) ?>
            <?= ListView::widget([
                'pager' => ['class' => 'app\widgets\LinkPager'],
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'row directory-index-page-item',
                    'id' => 'list-wrapper',
                ],
                'summaryOptions' => [
                    'class' => 'col-12'
                ],
                'layout' => <<< HTML
                    <div class="col-md-12 mb-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{summary}</div>
                            <div>{pager}</div>
                        </div>
                    </div>
                    {items}
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>{summary}</div>
                            <div>{pager}</div>
                        </div>
                    </div>
                HTML,
                'itemView' => '_item-card',
                'beforeItem' => function ($model, $key, $index, $widget) {
                    return '<div class="col-md-3">';
                },
                'afterItem' => function ($model, $key, $index, $widget) {
                    return '</div>';
                },
            ]); ?>
        <?php $this->endContent() ?>
    <?php endforeach ?>
</div>