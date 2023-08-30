<?php

use app\models\Directory;
use app\models\search\DirectorySearch;
use app\widgets\ConfirmBulkAction;

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
$this->params['headerButtons'] = Directory::createButton();
$this->params['searchModel'] = new DirectorySearch();
$this->params['activeMenuLink'] = '/directory/card';
?>
<div class="directory-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	]) ?>
</div>