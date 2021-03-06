<?php

namespace AccSync\FlexiBee\Requests\GetDataRequest;

/**
 * Class IssuedInvoiceRequest
 *
 * @package AccSync\FlexiBee\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class IssuedInvoiceRequest extends BaseGetDataRequest
{
    const REGISTER = 'faktura-vydana';

    protected $register = self::REGISTER;
}