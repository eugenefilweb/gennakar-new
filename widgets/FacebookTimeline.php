<?php

namespace app\widgets;

class FacebookTimeline extends BaseWidget
{
    public $sdkOnly = false;

    public $pageLink;
    public $pageName;
    public $containerClass = 'fb-page';
    public $tabs = 'timeline';
    public $width = 500;
    public $height = 1000;
    public $small_header = false;
    public $adapt_container_width = true;
    public $hide_cover = false;
    public $show_facepile = true;


    public $blockquoteClass = 'fb-xfbml-parse-ignore';
    private $blockquoteOptions = [];
    private $containerOptions = [];
 
    public function init() 
    {
        // your logic here
        parent::init();

        $this->containerOptions['class'] = $this->containerClass;
        $this->containerOptions['data-href'] = $this->pageLink;
        $this->containerOptions['data-tabs'] = $this->tabs;
        $this->containerOptions['data-width'] = $this->width;
        $this->containerOptions['data-height'] = $this->height;
        $this->containerOptions['data-small-header'] = $this->small_header ? 'true': 'false';
        $this->containerOptions['data-adapt-container-width'] = $this->adapt_container_width ? 'true': 'false';
        $this->containerOptions['data-hide-cover'] = $this->hide_cover ? 'true': 'false';
        $this->containerOptions['data-show-facepile'] = $this->show_facepile ? 'true': 'false';


        $this->blockquoteOptions['cite'] = $this->pageLink;
        $this->blockquoteOptions['class'] = $this->blockquoteClass;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    { 
        if ($this->sdkOnly) {
            return $this->render('facebook-timeline/sdk');
        }

        return $this->render('facebook-timeline/index', [
            'blockquoteOptions' => $this->blockquoteOptions,
            'containerOptions' => $this->containerOptions,
            'pageName' => $this->pageName,
            'pageLink' => $this->pageLink,
        ]);
    }
}
