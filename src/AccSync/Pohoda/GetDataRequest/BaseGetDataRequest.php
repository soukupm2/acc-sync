<?php

namespace AccSync\Pohoda\GetDataRequest;

/**
 * Class BaseGetDataRequest
 *
 * @package AccSync\Pohoda\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
abstract class BaseGetDataRequest
{
    /**
     * @var string $filterPrefix Prefix for every filter
     */
    private $filterPrefix = 'ftr:';
    /**
     * @var string $filterPrefix Root element for filter
     */
    private $filterRootElement = 'ftr:filter';
    /**
     * @const string Filtering new or changed records from specified day
     */
    const FILTER_LAST_CHANGES = 'lastChanges';

    /**
     * @var string $requestId Request ID, it is in the response for identification
     */
    protected $requestId;
    /**
     * @var string $in Identification number of company, must be in every request
     */
    protected $in;
    /**
     * @var \SimpleXMLElement $requestXml Request XML
     */
    protected $requestXml;
    /**
     * @var \SimpleXMLElement $filterParent Element, after which should be filter appended
     */
    protected $filterParent;

    /**
     * BaseGetDataRequest constructor.
     *
     * @param string $requestId Request ID, it is in the response for identification
     * @param string $in        Identification number of company, must be in every request
     */
    public function __construct($requestId, $in)
    {
        $this->requestId = $requestId;
        $this->in = $in;
    }

    /**
     * Returns name of the class
     * Used in note for requests
     *
     * @return string
     */
    protected function getNote()
    {
        return get_class($this);
    }

    /**
     * Returns identification number
     *
     * @return string
     */
    public function getIn()
    {
        return $this->in;
    }

    /**
     * Returns ID of request
     *
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Formats the date for request
     *
     * @param \DateTime $date
     * @return string
     */
    protected function formatDate(\DateTime $date)
    {
        return $date->format('Y-m-d') . 'T' . $date->format('H:i:s');
    }

    /**
     * Adds filter to XML
     *
     * @param string $filterType
     * @param mixed $value
     */
    public function addFilter($filterType, $value)
    {
        if (!isset($this->filterParent->{$this->filterRootElement}))
        {
            $filter = $this->filterParent
                ->addChild('ftr:filter', '', 'http://www.stormware.cz/schema/version_2/filter.xsd');
        }
        else
        {
            $filter = $this->filterParent->{$this->filterRootElement};
        }

        if ($filterType === self::FILTER_LAST_CHANGES && $value instanceof \DateTime)
        {
            $value = $this->formatDate($value);
        }

        $filterType = $this->filterPrefix . $filterType;

        $filter->addChild($filterType, $value);
    }

    /**
     * Returns string with XML specified for request purposes
     *
     * @return \SimpleXMLElement
     */
    public abstract function getXmlRequestString();
}