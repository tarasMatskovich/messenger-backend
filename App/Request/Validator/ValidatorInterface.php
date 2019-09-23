<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 23.09.2019
 * Time: 18:06
 */

namespace App\Request\Validator;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface ValidatorInterface
 * @package App\Request\Validator
 */
interface ValidatorInterface
{

    /**
     * @param ServerRequestInterface $request
     * @param array $rules
     * @return bool
     */
    public function validate(ServerRequestInterface $request, array $rules);

}
