<?php

namespace App\Factory;

use App\ApplicationInterface;
use App\Factory\Enum\ApplicationTypesEnum;
use App\HttpApplication;
use App\Container\ContainerInterface;
use App\Request\Builder\PipelineBuilder\PipelineBuilderInterface;
use App\Request\Builder\RequestBuilderInterface;
use App\Router\RouterInterface;
use App\WampApplication;

/**
 * Class ApplicationFactory
 * @package App\Factory
 */
class ApplicationFactory implements ApplicationFactoryInterface
{

    /**
     * @var RequestBuilderInterface
     */
    private $requestBuilder;

    /**
     * ApplicationFactory constructor.
     * @param RequestBuilderInterface $requestBuilder
     */
    public function __construct(
        RequestBuilderInterface $requestBuilder
    )
    {
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * @param string $applicationType
     * @param ContainerInterface $container
     * @param RouterInterface $router
     * @return ApplicationInterface
     * @throws ApplicationFactoryException
     * @throws \Exception
     */
    public function make(string $applicationType, ContainerInterface $container, RouterInterface $router)
    {
        switch ($applicationType) {
            case ApplicationTypesEnum::APP_WAMP:
                $pipelineBuilder = $container->get(PipelineBuilderInterface::class);
                return new WampApplication($container, $router, $this->requestBuilder, $pipelineBuilder);
                break;
            default:
                throw new ApplicationFactoryException("Undefined application type!");
                break;
        }
    }


}
