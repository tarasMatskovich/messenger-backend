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
     * @var array
     */
    private $skippedActions = [];

    /**
     * PipelineBuilder constructor.
     * @param MiddlewareInterface[] $middlewares
     * @param array $skippedActions
     */
    public function __construct(array $middlewares, array $skippedActions)
    {
        $this->middlewares = $middlewares;
        $this->skippedActions = $skippedActions;
    }


    /**
     * @param string $action
     * @return PipelineInterface
     */
    public function build(string $action): PipelineInterface
    {
        $pipeline = new Pipeline();
        foreach ($this->middlewares as $middleware) {
            $skippedMiddlewaresForAction = $this->skippedActions[$action] ?? [];
            if (!\in_array(get_class($middleware), $skippedMiddlewaresForAction)) {
                $pipeline = $pipeline->pipe($middleware);
            }
        }
        return $pipeline;
    }
}
