<?php

$alises = [
	// local
	'@uploads' => dirname(dirname(__DIR__)) . '/web/protected/uploads',
	'@backups' => dirname(dirname(__DIR__)) . '/web/protected/backups',
    '@export' => dirname(dirname(__DIR__)) . '/web/protected/exports',

    // live
	/*'@uploads' => dirname(dirname(__DIR__)) . '/../public_html/gennakar/protected/uploads',
	'@backups' => dirname(dirname(__DIR__)) . '/../public_html/gennakar/protected/backups',
	'@export' => dirname(dirname(__DIR__)) . '/../public_html/gennakar/protected/exports',*/
];

foreach ($alises as $key => $value) {
	\Yii::setAlias($key, $value);
}
