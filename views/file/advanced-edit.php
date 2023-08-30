<?php

$this->registerJsFile("https://unpkg.com/react@16.13.1/umd/react.production.min.js", [
	'position' => \yii\web\View::POS_HEAD
]);
$this->registerJsFile("https://unpkg.com/react-dom@16.13.1/umd/react-dom.production.min.js", [
	'position' => \yii\web\View::POS_HEAD
]);
$this->registerJsFile("https://unpkg.com/react-dom@16.13.1/umd/react-dom-server.browser.production.min.js", [
	'position' => \yii\web\View::POS_HEAD
]);
$this->registerJsFile("https://unpkg.com/styled-components@4.4.1/dist/styled-components.min.js", [
	'position' => \yii\web\View::POS_HEAD
]);
$this->registerJsFile("https://cdn.img.ly/packages/imgly/photoeditorsdk/latest/umd/no-polyfills.js", [
	'position' => \yii\web\View::POS_HEAD
]);

$location = \app\helpers\Url::home(true) . ($model->location);

$this->registerJs(<<< JS
	PhotoEditorSDK.PhotoEditorSDKUI.init({
        container: '#editor',
        // Please replace this with your license: https://img.ly/dashboard
        license: '',
        image:
          '{$location}',
        assetBaseUrl:
          'https://cdn.img.ly/packages/imgly/photoeditorsdk/latest/assets',
      });
JS);

?>


<div id="editor" style="width: 100vw; height: 100vh;"></div>
