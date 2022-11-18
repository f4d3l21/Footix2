<?php

namespace ContainerZeCxUVt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_3jTAzhMService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.3jTAzhM' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.3jTAzhM'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cache' => ['privates', 'cache.app.taggable', 'getCache_App_TaggableService', true],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', true],
            'pictureRepository' => ['privates', 'App\\Repository\\PictureRepository', 'getPictureRepositoryService', true],
        ], [
            'cache' => '?',
            'entityManager' => '?',
            'pictureRepository' => 'App\\Repository\\PictureRepository',
        ]);
    }
}