<?php

namespace app\modules\api\v1\controllers;

use yii\web\Response;

/**
 * Default controller for the `api` module
 */
abstract class ActiveController extends \yii\rest\ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
            // 'application/xml' => Response::FORMAT_XML,
            // 'text/html' => Response::FORMAT_HTML
        ];
        $behaviors['corsFilter'] = [
            'class' => 'yii\filters\Cors',
            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // Allow only headers '*'
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['*'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                // 'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 86400,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                // 'Access-Control-Expose-Headers' => true,
            ],
        ];

        // Supporting Authenticator
        // sample request
        // http://[host]/api/v1/user/available-users?access-token=access-fGurkHEAh4OSAT6BuC66_1621994603

        
        $behaviors['authenticator'] = [
            'class' => 'yii\filters\auth\CompositeAuth',
            'authMethods' => [
                'yii\filters\auth\HttpBasicAuth',
                'yii\filters\auth\HttpBearerAuth',
                'yii\filters\auth\QueryParamAuth',
            ],
        ];
        return $behaviors;
    }
}