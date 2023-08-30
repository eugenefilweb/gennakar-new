<?php

namespace app\widgets;

class WidgetBot extends BaseWidget
{
    public $server = '1032447142524100650';
    public $channel = '1032447143048380478';
    public $width = '100%';
    public $height = '700';
    public $js = 'https://cdn.jsdelivr.net/npm/@widgetbot/html-embed';

    public $options;

    public function init()
    {
        parent::init();

        $this->options = [
            'server' => $this->server,
            'channel' => $this->channel,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('widgetbot', [
            'options' => $this->options,
            'js' => $this->js
        ]);
    }
}
