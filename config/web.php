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
        'db'  => require (__DIR__. '/db.php'),
        'urlManager'    => [
            'enablePrettyUrl'   => true,
            'showScriptName'    => false,
        ],
    ],
    'modules'   => [

    ],
    'extensions' => require(__DIR__. '/../vendor/yiisoft/extensions.php'),
];