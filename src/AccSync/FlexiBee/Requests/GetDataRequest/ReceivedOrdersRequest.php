<?php

namespace AccSync\FlexiBee\Requests\GetDataRequest;

/**
 * Class ReceivedOrdersRequest
 *
 * @package AccSync\FlexiBee\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class ReceivedOrdersRequest extends BaseGetDataRequest
{
    const REGISTER = 'objednavka-prijata';

    protected $register = self::REGISTER;
}