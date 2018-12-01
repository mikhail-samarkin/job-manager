<?php
namespace app\bootstrap;

use app\common\dispatchers\DummyEventDispatcher;
use app\common\dispatchers\EventDispatcher;
use app\common\repositories\ARVacancyRepository;
use app\common\repositories\VacancyRepository;
use yii\base\BootstrapInterface;

class ContainerBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(EventDispatcher::class, DummyEventDispatcher::class);
        $container->setSingleton(VacancyRepository::class, ARVacancyRepository::class);
    }
}