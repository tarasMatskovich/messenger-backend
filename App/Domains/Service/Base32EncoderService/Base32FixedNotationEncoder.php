<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 11:25
 */

namespace App\Domains\Service\Base32EncoderService;


use Sonata\GoogleAuthenticator\FixedBitNotation;

/**
 * Class Base32FixedNotationEncoder
 * @package App\Domains\Service\Base32EncoderService
 */
class Base32FixedNotationEncoder implements Base32Interface
{

    /**
     * @var FixedBitNotation|null
     */
    private $fixedBit;

    /**
     * @param $string
     * @return string
     */
    public function encode($string): string
    {
        return $this->getFixedBitNotation()->encode($string);
    }

    /**
     * @return FixedBitNotation
     */
    private function getFixedBitNotation()
    {
        if (!$this->fixedBit) {
            $this->fixedBit = new FixedBitNotation(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', true, true);
        }
        return $this->fixedBit;
    }

    /**
     * @param $string
     * @return string
     */
    public function decode($string): string
    {
        return $this->getFixedBitNotation()->decode($string);
    }
}
