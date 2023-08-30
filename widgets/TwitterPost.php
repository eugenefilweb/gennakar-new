<?php

namespace app\widgets;

class TwitterPost extends BaseWidget
{
    public $link;
    public $height;
    public $linkOptions = [
        'class' => 'twitter-timeline',
    ];
    public $title;
    public $name;

    public function init() 
    {
        // your logic here
        parent::init();

        if ($this->height) {
            $this->linkOptions['data-height'] = $this->height;
        }

        if ($this->name) {
            $this->link = "https://twitter.com/{$this->name}?ref_src=twsrc%5Etfw";
        }

        $this->title = $this->title ?: "Loading tweets by {$this->name}...";
    }

  

    /**
     * {@inheritdoc}
     */
    public function run()
    { 
        return $this->render('twitter-post', [
            'link' => $this->link,
            'linkOptions' => $this->linkOptions,
            'title' => $this->title,
        ]);
    }
}
