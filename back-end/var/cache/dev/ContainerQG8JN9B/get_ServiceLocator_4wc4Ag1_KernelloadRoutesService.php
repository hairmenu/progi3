<?php

namespace ContainerQG8JN9B;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_4wc4Ag1_KernelloadRoutesService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.4wc4Ag1.kernel::loadRoutes()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.4wc4Ag1.kernel::loadRoutes()'] = ($container->privates['.service_locator.4wc4Ag1'] ?? $container->load('get_ServiceLocator_4wc4Ag1Service'))->withContext('kernel::loadRoutes()', $container);
    }
}
