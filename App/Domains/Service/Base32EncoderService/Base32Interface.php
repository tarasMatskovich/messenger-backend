<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 11:23
 */

namespace App\Domains\Service\Base32EncoderService;

/**
 * Interface Base32Interface
 * @package App\Domains\Service\Base32EncoderService
 */
interface Base32Interface
{

    /**
     * @param $string
     * @return string
     */
    public function encode($string): string;

    /**
     * @param $string
     * @return string
     */
    public function decode($string): string;

}
