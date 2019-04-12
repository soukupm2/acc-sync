<?php

namespace AccSync\FlexiBee\Requests\GetDataRequest;

/**
 * Class PriceListRequest
 *
 * @package AccSync\FlexiBee\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class PriceListRequest extends BaseGetDataRequest
{
    const REGISTER = 'cenik';

    protected $register = self::REGISTER;
}