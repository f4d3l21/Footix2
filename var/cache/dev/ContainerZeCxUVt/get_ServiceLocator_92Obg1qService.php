<?php

namespace ContainerZeCxUVt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_92Obg1qService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.92Obg1q' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.92Obg1q'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cache' => ['privates', 'cache.app.taggable', 'getCache_App_TaggableService', true],
            'serializer' => ['services', 'jms_serializer', 'getJmsSerializerService', true],
            'teamRepository' => ['privates', 'App\\Repository\\TeamRepository', 'getTeamRepositoryService', true],
        ], [
            'cache' => '?',
            'serializer' => '?',
            'teamRepository' => 'App\\Repository\\TeamRepository',
        ]);
    }
}
