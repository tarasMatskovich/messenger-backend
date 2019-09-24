<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 24.09.2019
 * Time: 16:23
 */

namespace App\Request\Builder\PipelineBuilder;

use App\Request\Builder\PipelineBuilder\PipeLine\PipelineInterface;

/**
 * Interface PipelineBuilderInterface
 * @package App\Request\Builder\PipelineBuilder
 */
interface PipelineBuilderInterface
{

    /**
     * @return PipelineInterface
     */
    public function build(): PipelineInterface;

}
