<?php

namespace ContainerZeCxUVt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNelmioApiDoc_Describers_Route_DefaultService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'nelmio_api_doc.describers.route.default' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Describer\RouteDescriber
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/nelmio/api-doc-bundle/Describer/DescriberInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/nelmio/api-doc-bundle/Describer/ModelRegistryAwareInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/nelmio/api-doc-bundle/Describer/ModelRegistryAwareTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/nelmio/api-doc-bundle/Describer/RouteDescriber.php';
        include_once \dirname(__DIR__, 4).'/vendor/nelmio/api-doc-bundle/Util/ControllerReflector.php';

        return $container->privates['nelmio_api_doc.describers.route.default'] = new \Nelmio\ApiDocBundle\Describer\RouteDescriber(($container->privates['nelmio_api_doc.routes.default'] ?? $container->load('getNelmioApiDoc_Routes_DefaultService')), ($container->privates['nelmio_api_doc.controller_reflector'] ?? ($container->privates['nelmio_api_doc.controller_reflector'] = new \Nelmio\ApiDocBundle\Util\ControllerReflector($container))), new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['nelmio_api_doc.route_describers.php_doc'] ?? ($container->privates['nelmio_api_doc.route_describers.php_doc'] = new \Nelmio\ApiDocBundle\RouteDescriber\PhpDocDescriber()));
            yield 1 => ($container->privates['nelmio_api_doc.route_describers.route_metadata'] ?? ($container->privates['nelmio_api_doc.route_describers.route_metadata'] = new \Nelmio\ApiDocBundle\RouteDescriber\RouteMetadataDescriber()));
        }, 2));
    }
}
