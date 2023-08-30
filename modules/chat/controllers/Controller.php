<?php

namespace app\modules\chat\controllers;

use app\modules\chat\helpers\App;
use yii\web\ForbiddenHttpException;

abstract class Controller extends \app\controllers\Controller
{
	// public $enableCsrfValidation = false;
	public $layout = 'main';

	public function beforeAction($action)
	{
		if (! parent::beforeAction($action)) {
			return false;
		}

		if (App::isGuest()) {
			$this->redirect(['/site/index']);

			return false;
		}

		if (! App::identity()->can('index', 'community-board')) {
			throw new ForbiddenHttpException("Forbidden access", 403);
			
			return false;
		}

		return true;
	}
}