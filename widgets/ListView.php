<?php

namespace app\widgets;

class ListView extends \yii\widgets\ListView
{
	public $pager = ['class' => 'app\widgets\LinkPager'];
}