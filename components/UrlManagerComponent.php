<?php

namespace app\components;

class UrlManagerComponent extends \yii\web\UrlManager
{
    public $enablePrettyUrl = true;
    public $showScriptName = false;
    public $rules = [
        [
            'class' => 'yii\rest\UrlRule', 
            'controller' => ['api/v1/user', 'api/v1/library'],
            'pluralize' => false
        ],
        '/' => 'site/index',

        'organizational-chart/export/<version>' => 'organizational-chart/export',

        'community-board/<token>' => 'community-board/default/index',
        'community-board' => 'community-board/default/index',
        'community-board/<controller>/<action>/<token>' => 'community-board/<controller>/<action>',
        'community-board/<controller>/<action>' => 'community-board/<controller>/<action>', 

        'my-files' => 'file/my-files',
        'my-setting' => 'setting/my-setting',
        'my-role' => 'role/my-role',
        'my-account' => 'user/my-account',
        'my-password' => 'user/my-password',

        '<action:index|login|reset-password|contact|about|home>' => 'site/<action>',

        'setting/general/<tab>' => 'setting/general',
        'setting/general' => 'setting/general',
        
        'open-event' => 'un-planned-attendees-event/index',
        'open-event/<action>' => 'un-planned-attendees-event/<action>',

        '<controller>' => '<controller>/index',
        '<controller:(notification|event|tech-issue)>/<action>/<token>' => '<controller>/<action>',

        '<controller:(post-activity-report|post-accident-report)>/<action>/<control_no>' => '<controller>/<action>',

        '<controller:(meeting|inventory-item|watershed|masterlist|social-pensioner|event-category|setting|ip|user|theme|backup|role|transaction|transaction-type|assistance-type)>/<action>/<slug>' => '<controller>/<action>',
        '<controller:(member)>/<action>/<qr_id>' => '<controller>/<action>',

        '<controller>/<id:\d+>' => '<controller>/view',
        '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
        '<controller>/<action>' => '<controller>/<action>', 
    ];
}