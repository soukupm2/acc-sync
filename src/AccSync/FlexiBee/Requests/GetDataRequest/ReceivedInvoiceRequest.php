<?php

namespace AccSync\FlexiBee\Requests\GetDataRequest;

/**
 * Class ReceivedInvoiceRequest
 *
 * @package AccSync\FlexiBee\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class ReceivedInvoiceRequest extends BaseGetDataRequest
{
    const REGISTER = 'faktura-prijata';

    protected $register = self::REGISTER;
}