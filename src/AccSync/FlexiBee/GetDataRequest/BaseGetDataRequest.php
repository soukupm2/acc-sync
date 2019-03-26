<?php

namespace AccSync\FlexiBee\GetDataRequest;

/**
 * Class BaseGetDataRequest
 *
 * @package AccSync\FlexiBee\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
abstract class BaseGetDataRequest
{
    /**
     * @var string $register Name of the register
     */
    protected $register;
    /**
     * @var string $customUrl
     */
    protected $customUrl;
    /**
     * @var bool $summedResult
     */
    protected $summedResult = FALSE;
    /**
     * @var string $urlFilter
     */
    protected $urlFilter;

    /**
     * @return string
     */
    public function getRegister()
    {
        return $this->register;
    }

    /**
     * @return string
     */
    public function getCustomUrl()
    {
        return $this->customUrl;
    }

    /**
     * @param bool $sumResult
     */
    public function sum($sumResult = TRUE)
    {
        $this->summedResult = $sumResult;
    }

    /**
     * @return bool
     */
    public function isSummedResult()
    {
        return $this->summedResult;
    }

    /**
     * @param string $customUrl
     */
    public function setCustomUrl($customUrl)
    {
        $this->customUrl = $customUrl;
    }

    /**
     * @return string
     */
    public function getUrlFilter()
    {
        return $this->urlFilter;
    }

    /**
     * @param string $urlFilter
     */
    public function setUrlFilter($urlFilter)
    {
        $this->urlFilter = $urlFilter;
    }
}