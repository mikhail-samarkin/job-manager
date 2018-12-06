<?php
return [
    'id'            => 'job-manager',
    'basePath'      => realpath(__DIR__.'/../'),
    'language'      => 'ru',
    'components'    => [
        'request'  => [
            'cookieValidationKey'   => 'sasdvaszdvzvZCzdvdgbdfad',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
        ],
        'db'  => require(__DIR__. '/db.php'),
        'urlManager'    => [
            'enablePrettyUrl'   => true,
            'showScriptName'    => false,
        ],
    ],
    'modules'   => [
        'api'   => [
            'class' => 'app\modules\api\ApiModule'
        ]
    ],
    'bootstrap' => [
        'log',
        'app\bootstrap\ContainerBootstrap',
    ],
];
