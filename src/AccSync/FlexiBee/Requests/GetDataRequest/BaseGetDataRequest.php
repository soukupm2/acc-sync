<?php

namespace AccSync\FlexiBee\Requests\GetDataRequest;

use AccSync\FlexiBee\Enum\EDefinedValues;
use AccSync\FlexiBee\Requests\BaseRequest;

/**
 * Class BaseGetDataRequest
 *
 * @package AccSync\FlexiBee\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
abstract class BaseGetDataRequest extends BaseRequest
{
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
     * @var string $order
     */
    protected $order;
    /**
     * @var string $limit
     */
    protected $limit = 'limit=0';

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

        return $this;
    }

    /**
     * Sets the order of results
     *
     * @param string $by
     * @param string $dir
     */
    public function setOrder($by, $dir = EDefinedValues::ASC)
    {
        if ($dir !== EDefinedValues::ASC && $dir !== EDefinedValues::DESC)
        {
            $dir = EDefinedValues::ASC;
        }

        $this->order = 'sort=' . $by . '&dir=' . $dir;

        return $this;
    }

    /**
     * Sets the limit of results
     * 0 = All results
     *
     * @param int $limit
     * @param int $offset
     */
    public function setLimit($limit = 0, $offset = 0)
    {
        if (!is_null($limit))
        {
            $this->limit = 'limit=' . $limit;
        }

        if (!empty($offset))
        {
            $this->limit .= '&start=' . $offset;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getLimit()
    {
        return $this->limit;
    }
}