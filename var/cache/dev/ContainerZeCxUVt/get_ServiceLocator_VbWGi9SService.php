<?php

namespace ContainerZeCxUVt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_VbWGi9SService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.VbWGi9S' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.VbWGi9S'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cache' => ['privates', 'cache.app.taggable', 'getCache_App_TaggableService', true],
            'repository' => ['privates', 'App\\Repository\\RencontreRepository', 'getRencontreRepositoryService', true],
            'serializer' => ['services', 'jms_serializer', 'getJmsSerializerService', true],
        ], [
            'cache' => '?',
            'repository' => 'App\\Repository\\RencontreRepository',
            'serializer' => '?',
        ]);
    }
}