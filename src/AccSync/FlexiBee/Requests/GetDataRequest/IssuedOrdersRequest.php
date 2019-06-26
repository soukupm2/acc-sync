<?php

namespace AccSync\FlexiBee\Requests\GetDataRequest;

/**
 * Class IssuedOrdersRequest
 *
 * @package AccSync\FlexiBee\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class IssuedOrdersRequest extends BaseGetDataRequest
{
    const REGISTER = 'objednavka-vydana';

    protected $register = self::REGISTER;
}