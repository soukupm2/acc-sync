<?php

namespace AccSync\FlexiBee;

/**
 * Class BaseRequest
 *
 * @package AccSync\FlexiBee
 * @author miroslav.soukup2@gmail.com
 */
abstract class BaseRequest
{
    /**
     * @var string $register Name of the register
     */
    protected $register;

    /**
     * @return string
     */
    public function getRegister()
    {
        return $this->register;
    }
}