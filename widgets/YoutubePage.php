<?php

namespace app\widgets;

use app\helpers\App;
 
class YoutubePage extends BaseWidget
{
    public $baseUrl = 'https://www.youtube-nocookie.com/embed';
    public $user_uploads = 'playlist';
    public $channelId = 'UUpyLikj1x70S8UPxVqsPr6g';
    public $width = '100%';
    public $height = 700;
    public $frameborder = 0;
    public $allowfullscreen = true;
    public $src;
    public $frameOptions;
    

    public function init() 
    {
        parent::init();
        
        $this->setTheList();

        $this->src = implode('?', [
            $this->baseUrl,
            http_build_query([
                'user_uploads' => $this->user_uploads,
                'list' => $this->channelId,
            ])
        ]);


        $this->frameOptions = [
            'width' => $this->width,
            'height' => $this->height,
            'frameborder' => $this->frameborder,
            'allowfullscreen' => $this->allowfullscreen,
            'src' => $this->src,
        ];
    }

    public function setTheList()
    {
        if (substr($this->channelId, 0, 2) == 'UU') {
            return $this->channelId;
        }

        $this->channelId = 'UU' . substr($this->channelId, 2);

        return $this->channelId;
    }

    public function run()
    { 
        return $this->render('youtube-page', [
            'frameOptions' => $this->frameOptions,
        ]);
    }
}
