<?php
return [
    'id'            => 'job-manager-console',
    'basePath'      => dirname(__DIR__),
    'components'    => [
        'db'  => require (__DIR__. '/db.php')
    ]
];