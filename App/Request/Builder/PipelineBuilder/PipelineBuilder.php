<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 24.09.2019
 * Time: 16:25
 */

namespace App\Request\Builder\PipelineBuilder;

use App\Request\Builder\PipelineBuilder\PipeLine\Pipeline;
use App\Request\Builder\PipelineBuilder\PipeLine\PipelineInterface;
use App\Request\Middleware\MiddlewareInterface;

/**
 * Class PipelineBuilder
 * @package App\Request\Builder\PipelineBuilder
 */
class PipelineBuilder implements PipelineBuilderInterface
{

    /**
     * @var MiddlewareInterface[]
     */
    private $middlewares;

    /**
     * PipelineBuilder constructor.
     * @param MiddlewareInterface[] $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }


    /**
     * @return PipelineInterface
     */
    public function build(): PipelineInterface
    {
        $pipeline = new Pipeline();
        foreach ($this->middlewares as $middleware) {
            $pipeline = $pipeline->pipe($middleware);
        }
        return $pipeline;
    }
}
