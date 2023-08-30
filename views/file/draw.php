<?php

use app\widgets\AnchorBack;

$this->title = "File Draw: {$model->mainAttribute}";
$this->addJsFile('image-editor/file-robot');
$this->addJsFile('js/image-editor', [], ['type' => 'module']);
$this->params['wrapCard'] = false;

$this->registerCss(<<< CSS
    #editor_container {height: 75vh;}
CSS);
?>

<div id="editor_container" data-src="<?= $model->absoluteLocation ?>"></div>

