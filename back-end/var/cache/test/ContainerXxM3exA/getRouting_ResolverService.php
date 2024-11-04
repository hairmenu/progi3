<?php

namespace ContainerXxM3exA;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getRouting_ResolverService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'routing.resolver' shared service.
     *
     * @return \Symfony\Component\Config\Loader\LoaderResolver
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/config/Loader/LoaderResolverInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/config/Loader/LoaderResolver.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/config/Loader/LoaderInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/routing/Loader/AttributeClassLoader.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Routing/AttributeRouteControllerLoader.php';

        $container->privates['routing.resolver'] = $instance = new \Symfony\Component\Config\Loader\LoaderResolver();

        $instance->addLoader(($container->privates['routing.loader.xml'] ?? $container->load('getRouting_Loader_XmlService')));
        $instance->addLoader(($container->privates['routing.loader.yml'] ?? $container->load('getRouting_Loader_YmlService')));
        $instance->addLoader(($container->privates['routing.loader.php'] ?? $container->load('getRouting_Loader_PhpService')));
        $instance->addLoader(($container->privates['routing.loader.glob'] ?? $container->load('getRouting_Loader_GlobService')));
        $instance->addLoader(($container->privates['routing.loader.directory'] ?? $container->load('getRouting_Loader_DirectoryService')));
        $instance->addLoader(($container->privates['routing.loader.container'] ?? $container->load('getRouting_Loader_ContainerService')));
        $instance->addLoader(($container->privates['routing.loader.attribute'] ??= new \Symfony\Bundle\FrameworkBundle\Routing\AttributeRouteControllerLoader('test')));
        $instance->addLoader(($container->privates['routing.loader.attribute.directory'] ?? $container->load('getRouting_Loader_Attribute_DirectoryService')));
        $instance->addLoader(($container->privates['routing.loader.attribute.file'] ?? $container->load('getRouting_Loader_Attribute_FileService')));
        $instance->addLoader(($container->privates['routing.loader.psr4'] ?? $container->load('getRouting_Loader_Psr4Service')));

        return $instance;
    }
}
