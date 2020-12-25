<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'MrQsU247npsU3Q5bRP8BNff3_hESH80H',
             'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
			'format'         => yii\web\Response::FORMAT_JSON,
			'charset'        => 'UTF-8',
            // @todo: move this to a separate event handler class (?)
            'on beforeSend'  => function ($event) {
                $response = $event->sender;

                // Because Yii2 CORS doesn't handle this 
                // @todo file a bug for this
                $response->headers['Access-Control-Allow-Headers'] = 'x-auth-token, Content-Type';
                $response->headers['Access-Control-Request-Method'] = 'GET, POST, PUT, OPTIONS, HEAD';

                if (\Yii::$app->request->getIsOptions())
                {
                    $response->statusCode = 200;
                    $response->data = null;
                }
                else
                {
                    if ($response->statusCode != 200)
                        $response->headers['Access-Control-Allow-Origin'] = '*';
                }
                
                if ($response->data !== null)
                {
                    $return = ($response->statusCode == 200 ? $response->data : $response->data['message']);

                    $response->data = [
                        'success'   =>  ($response->statusCode === 200),
                        'status'    => $response->statusCode,
                        'response'  => $return
                    ];
                }
            }
		],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => false,
            'loginUrl'      => null
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'site/<action>', 'route' => 'site/<action>']
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => require(__DIR__ . '/params.php'),
];

if (APPLICATION_ENV == "dev")
{
    $config['bootstrap'][] = 'gii';
    $config['modules'] = [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ] 
    ];
}

return $config;