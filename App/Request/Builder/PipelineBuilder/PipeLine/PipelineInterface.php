<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 24.09.2019
 * Time: 16:27
 */

namespace App\Request\Builder\PipelineBuilder\PipeLine;

use actions\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface PipelineInterface
 * @package App\Request\Builder\PipelineBuilder\PipeLine
 */
interface PipelineInterface
{

    /**
     * @param ActionInterface $payload
     * @return static
     */
    public function pipe(ActionInterface $payload);

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    public function process(ServerRequestInterface $request);

}
