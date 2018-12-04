<?php
$config =  yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/web.php'),
    [
        'id' => 'job-manager-tests',
        'components' => [
            'db' => [
                'dsn'       => 'pgsql:host=db;port=5432;dbname=job_manager',
                'username'  => 'job_manager',
                'password'  => 'job_manager'
            ]
        ]
    ]
);
return $config;
