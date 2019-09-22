<?php


namespace App\Router\Factory;

use App\Factory\Enum\ApplicationTypesEnum;
use App\Router\HttpRouter;
use App\Router\Router;
use App\Router\RouterInterface;

/**
 * Class RouterFactory
 * @package App\router\factory
 */
class RouterFactory implements RouterFactoryInterface
{

    /**
     * @param string $buildKey
     * @param array $routes
     * @param array $httpRoutes
     * @return RouterInterface
     * @throws RouterFactoryException
     */
    public function make(string $buildKey, array $routes, array $httpRoutes = [])
    {
        switch ($buildKey) {
            case ApplicationTypesEnum::APP_HTTP:
                return new HttpRouter(new Router($routes), $httpRoutes);
            case ApplicationTypesEnum::APP_WAMP:
                return new Router($routes);
        }
        throw new RouterFactoryException("Undefined application build key");
    }
}