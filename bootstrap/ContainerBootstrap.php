<?php
declare(strict_types=1);

namespace app\bootstrap;

use app\common\repositories\ARVacancyRepository;
use app\common\repositories\VacancyRepositoryInterface;
use Yii;
use yii\base\BootstrapInterface;

/**
 * Class ContainerBootstrap
 *
 * Class contains setup application
 *
 * @package app\bootstrap
 */
class ContainerBootstrap implements BootstrapInterface
{
    /**
     * Custom bootstrap application
     *
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;
        $container->setSingleton(VacancyRepositoryInterface::class, ARVacancyRepository::class);
    }
}