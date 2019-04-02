<?php

namespace AccSync\FlexiBee\GetDataRequest;

/**
 * Class ReceivedInvoiceRequest
 *
 * @package AccSync\FlexiBee\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class ReceivedInvoiceRequest
{
    const REGISTER = 'faktura-vydana';

    protected $register = self::REGISTER;
}