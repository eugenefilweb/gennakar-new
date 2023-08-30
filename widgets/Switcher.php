<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Url;
 
class Switcher extends BaseWidget
{
    public $model;
    public $checked;
    public $onchange;
    public $data_link;
    public $controller;
    public $action;
    public $withConfirmation = false;

    public function init() 
    {
        // your logic here
        parent::init();
        $this->controller = $this->controller ?: App::controllerID();
        $this->data_link = $this->data_link ?: $this->getDataLink();
    }

    public function getDataLink()
    {
        if (isset($this->model->changeRecordStatusUrl)) {
            return $this->model->changeRecordStatusUrl;
        }

        return Url::to([$this->controller . '/' . $this->action]);
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('switcher', [
            'model' => $this->model,
            'withConfirmation' => $this->withConfirmation,
            'checked' => $this->checked,
            'onchange' => $this->onchange,
            'data_link' => $this->data_link,
            'id' => $this->id,
        ]);
    }
}
