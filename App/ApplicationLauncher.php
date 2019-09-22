<?php


namespace App;

use App\Factory\ApplicationFactoryInterface;
use App\Container\ContainerInterface;
use App\Router\Factory\RouterFactoryInterface;
use App\Router\Router;
use App\router\RouterInterface;
use Closure;
use React\EventLoop\Factory;

/**
 * Class ApplicationLauncher
 * @package App
 */
class ApplicationLauncher implements ApplicationLauncherInterface
{

    /**
     * @var string $buildKey
     */
    private $buildKey;

    /**
     * @var ApplicationFactoryInterface  $appFactory
     */
    private $appFactory;

    /**
     * @var ContainerInterface $container
     */
    private $container;


    /**
     * ApplicationLauncher constructor.
     * @param string $buildKey
     * @param ApplicationFactoryInterface $appFactory
     * @param ContainerInterface $container
     */
    public function __construct(
        string $buildKey,
        ApplicationFactoryInterface $appFactory,
        ContainerInterface $container
    )
    {
        $this->buildKey = $buildKey;
        $this->appFactory = $appFactory;
        $this->container = $container;
        $this->bootstrap();
    }

    /**
     * @returm void
     */
    public function bootstrap()
    {
        $eventLoop = Factory::create();
        $this->container->set('eventLoop', $eventLoop);
        $this->bootstrapBuildScripts();
    }

    private function bootstrapBuildScripts()
    {
        $buildScriptsList = require './bootstrap/buildscripts_list.php';
        foreach ($buildScriptsList as $buildScript) {
            $buildScript = require "./bootstrap/{$buildScript}.php";
            if ($buildScript instanceof Closure) {
                $buildScript($this->container);
            }
        }
    }

    /**
     * @return RouterInterface
     */
    public function createRouter()
    {
        $routes = require './config/routes.php';
        return new Router($routes);
    }

    /**
     * @return void
     */
    public function launch()
    {
        $router = $this->createRouter();
        $app = $this->appFactory->make($this->buildKey, $this->container, $router);
        $app->run();
    }
}