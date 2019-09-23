<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 23.09.2019
 * Time: 18:09
 */

namespace App\Request\Validator;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Validator
 * @package App\Request\Validator
 */
class Validator implements ValidatorInterface
{

    const REQUIRED = 'REQUIRED';

    const MIN = 'MIN';

    const MAX = 'MAX';

    /**
     * @param ServerRequestInterface $request
     * @param array $rules
     * @return bool
     */
    public function validate(ServerRequestInterface $request, array $rules)
    {
        // TODO MADE VALIDATOR
        return true;
    }
}
