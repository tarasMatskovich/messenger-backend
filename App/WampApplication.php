<?php


namespace App;

use actions\ActionInterface;
use App\Container\ContainerInterface;
use App\Request\Builder\PipelineBuilder\PipelineBuilderInterface;
use App\Request\Builder\RequestBuilderInterface;
use App\Response\Response;
use App\Router\RouterInterface;
use Evenement\EventEmitterInterface;
use Thruway\ClientSession;
use Thruway\Peer\Client;
use Thruway\Peer\ClientInterface;
use Thruway\Transport\PawlTransportProvider;

/**
 * Class WampApplication
 * @package App
 */
class WampApplication implements ApplicationInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ActionInterface[]
     */
    private $actions;

    /**
     * @var RequestBuilderInterface
     */
    private $requestBuilder;

    /**
     * @var ClientInterface|EventEmitterInterface
     */
    private $session;

    /**
     * @var PipelineBuilderInterface
     */
    private $pipelineBuilder;

    /**
     * WampApplication constructor.
     * @param ContainerInterface $container
     * @param RouterInterface $router
     * @param RequestBuilderInterface $requestBuilder
     * @param PipelineBuilderInterface $pipelineBuilder
     * @throws \Exception
     */
    public function __construct(
        ContainerInterface $container,
        RouterInterface $router,
        RequestBuilderInterface $requestBuilder,
        PipelineBuilderInterface $pipelineBuilder
    )
    {
        $this->container = $container;
        $this->router = $router;
        $this->requestBuilder = $requestBuilder;
        $this->pipelineBuilder = $pipelineBuilder;
        $this->beforeRun();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function beforeRun()
    {
        $this->actions = $this->router->getRoutes();
        $this->session = new Client("realm1", $this->container->get('eventLoop'));
        $this->session->addTransportProvider(new PawlTransportProvider("ws://127.0.0.1:8080/ws"));
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $this->session->on('open', function (ClientSession $session) {
            foreach ($this->actions as $key => $action) {
                $action = $this->container->get($action);
                $session->register($key, function ($arguments) use ($action) {
                    $request = $this->requestBuilder->build();
                    $attributes = json_decode($arguments[0], true);
                    $request = $this->requestBuilder->attachAttributesToRequest($request, $attributes);
                    $pipeline = $this->pipelineBuilder->build();
                    $responseData = $action($pipeline->process($request));
                    return new Response($responseData);
                });
            }
        });
        $this->session->start();
    }
}
