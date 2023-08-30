<?php

namespace app\widgets;

use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Autocomplete;

class Search extends BaseWidget
{
    const PLACEHOLDER = 'Search';
    const DEFAULT_CLASS = 'form-control';

    public $model;
    public $attribute = 'keywords';
    public $options;
    public $searchKeywordUrl;
    public $submitOnclick = false;

    public function init() 
    {
        // your logic here
        parent::init();

        $this->options['placeholder'] = $this->getPlaceholder();

        $this->options['class'] = $this->getClass();
        $this->options['name'] = $this->getInputName();
        $this->options['autofocus'] = true;

        if ($this->model->hasProperty('searchKeywordUrl')) {
            $this->searchKeywordUrl = $this->model->searchKeywordUrl;
        }

        if ($this->searchKeywordUrl) {
            $this->searchKeywordUrl = is_array($this->searchKeywordUrl) ? Url::toRoute($this->searchKeywordUrl): $this->searchKeywordUrl;
        }
        else {
            $this->searchKeywordUrl =  Url::to([implode('/', [
                $this->model->controllerID(),
                'find-by-keywords'
            ])]);

        }
    }

    public function getInputName()
    {
        if (isset($this->options['name'])) {
            return $this->options['name'];
        }
        return $this->attribute;
    }

    public function getClass()
    {
        if (isset($this->options['class'])) {
            return $this->options['class'];
        }
        return self::DEFAULT_CLASS;
    }

    public function getPlaceholder()
    {
        if (isset($this->options['placeholder'])) {
            return $this->options['placeholder'];
        }

        if (isset($this->model->searchLabel)) {
            return implode(' ', [self::PLACEHOLDER, $this->model->searchLabel]);
        }

        return self::PLACEHOLDER;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return Autocomplete::widget([
            'url' => $this->searchKeywordUrl,
            'submitOnclick' => $this->submitOnclick,
            'input' => Html::activeInput('search', $this->model, $this->attribute, $this->options)
        ]);
    }
}
