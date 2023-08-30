<?php

namespace app\widgets;

use app\helpers\App;
 
class Anchors extends BaseWidget
{
    public $controller;
    public $names;
    public $model;
    public $paramName = 'id';
    public $titles = [
        'index' => 'List',
        'log' => 'Data Logs',
    ];
    public $options = [
        'log' => ['class' => 'font-weight-bold btn btn-secondary btn-bold btn-upper btn-font-sm'],
        'index' => ['class' => 'font-weight-bold btn btn-secondary btn-bold btn-upper btn-font-sm'],
        'create' => ['class' => 'font-weight-bold btn btn-success font-weight-bolder font-size-sm btn-create'],
        'view' => ['class' => 'font-weight-bold btn btn-info font-weight-bolder font-size-sm '],
        'update' => ['class' => 'font-weight-bold btn btn-primary font-weight-bolder font-size-sm '],
        'duplicate' => ['class' => 'font-weight-bold btn btn-default font-weight-bolder font-size-sm '],
        'delete' => [
            'class' => 'font-weight-bold btn btn-danger btn-bold btn-upper btn-font-sm ',
            'data' => [
                'confirm' => 'Are you sure you want to delete this ?',
                'method' => 'post',
            ]
        ],
    ];
    public $anchors;
    public $glue = ' ';
    public $defaultOptions = ['class' => 'font-weight-bold btn btn-primary btn-bold btn-upper btn-font-sm'];
    public $forceTitle;
    public $iconOnly = false;

    public $icons = [
        'log' => '<i class="fa fa-book"></i>',
        'index' => '<i class="fa fa-list"></i>',
        'create' => '<i class="fa fa-plus"></i>',
        'view' => '<i class="fa fa-eye"></i>',
        'update' => '<i class="fa fa-edit"></i>',
        'duplicate' => '<i class="fa fa-copy"></i>',
        'delete' => '<i class="fa fa-trash"></i>',
    ];

    public $addtionalButtons;

    public function init() 
    {
        // your logic here
        parent::init();

        $controller = $this->controller ?: App::controllerID();
        $names = is_array($this->names) ? $this->names: [$this->names];


        foreach ($names as $name) {
            $title = $this->titles[$name] ?? ucwords($name);
            $title = $this->forceTitle ?: $title;
            $options = $this->options[$name] ?? $this->defaultOptions;

            switch ($name) { 
                case 'log':
                    $link = $this->model->logUrl;

                    if ($this->iconOnly) {
                        # code...
                    }
                    break;
                case 'index':
                case 'create':
                    $link = ["{$controller}/{$name}"];
                    // $title = $this->forceTitle ?: "{$title} " . App::controllerID();
                    break;
                case 'view':
                    $link = $this->model->viewUrl;
                    // $title = $this->forceTitle ?: "{$title} " . App::controllerID();
                    break;
                case 'update':
                    $link = $this->model->updateUrl;
                    $title = 'Edit';
                    // $title = $this->forceTitle ?: "{$title} " . App::controllerID();
                    break;
                case 'duplicate':
                    $link = $this->model->duplicateUrl;
                    // $title = $this->forceTitle ?: "{$title} " . App::controllerID();
                    break;
                case 'delete':
                    $link = $this->model->deleteUrl;
                    // $title = $this->forceTitle ?: "{$title} " . App::controllerID();
                    break;
                default:
                    break;
            }

            if ($this->iconOnly) {
                $options['title'] = $title;
                $options['data-toggle'] = 'tooltip';
                $title = $this->icons[$name] ?? $title;
                $options['class'] = ($options['class'] ?? 'btn btn-secondary') . ' btn-icon';
            }


            if ($this->model) {
                if (App::modelBeforeCan($this->model, $name)) {
                    if ($link) {
                        $this->anchors[] = Anchor::widget([
                            'title' => $title,
                            'link' => $link,
                            'options' => $options,
                        ]);
                    }
                }
            }
            else {
                if ($link) {
                    $this->anchors[] = Anchor::widget([
                        'title' => $title,
                        'link' => $link,
                        'options' => $options,
                    ]);
                }
            }
        } 
    }


 
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return  implode(' ', [
            implode($this->glue, $this->anchors ?: []),
            $this->addtionalButtons
        ]);
        // return <<< HTML
        //     <div class="text-right">
        //         {$content} 
        //     </div>
        // HTML;
    }
}
