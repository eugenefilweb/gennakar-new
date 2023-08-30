<?php

namespace app\widgets;

use app\models\Household;

class SearchHousehold extends BaseWidget
{
    public $model;
    public $title = 'Search QR Code';
    // public $template = '_add-transaction';
    public $template = 'default';

    public function init()
    {
        parent::init();

        $this->model = new Household();
    }

    public function run()
    {
        return $this->render("search-household/{$this->template}", [
            'model' => $this->model,
            'title' => $this->title,
            'template' => $this->template,
        ]);
    }
}
