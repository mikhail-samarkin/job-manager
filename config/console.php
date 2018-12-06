<?php
return [
    'id'            => 'job-manager-console',
    'basePath'      => dirname(__DIR__),
    'components'    => [
        'db'  => require(__DIR__. '/db.php'),
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => null,
            'migrationNamespaces' => [
                'app\common\migrations',
            ],
        ],
        'vacancy'   => [
            'class' => 'app\console\controllers\VacancyController'
        ],
    ],
    'bootstrap' => [
        'log',
        'app\bootstrap\ContainerBootstrap',
    ],
];
