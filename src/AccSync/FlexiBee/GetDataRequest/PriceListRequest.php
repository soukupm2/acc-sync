<?php

namespace AccSync\FlexiBee\GetDataRequest;

/**
 * Class PriceListRequest
 *
 * @package AccSync\FlexiBee\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class PriceListRequest extends BaseGetDataRequest
{
    const REGISTER = 'cenik';

    protected $register = self::REGISTER;
}