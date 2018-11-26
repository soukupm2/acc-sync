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
     * @const XML Namespace for data
     */
    const DATA_NAMESPACE = 'dat';
    /**
     * @const XML Namespace for stock
     */
    const STOCK_NAMESPACE = 'stk';
    /**
     * @const XML Namespace for filters
     */
    const FILTER_NAMESPACE = 'ftr';
    /**
     * @const XML Namespace for list stock
     */
    const LIST_STOCK_NAMESPACE = 'lStk';
    /**
     * @const XML Namespace for type
     */
    const TYPE_NAMESPACE = 'type';

    /**
     * @const string Filtering new or changed records from specified day
     */
    const FILTER_LAST_CHANGES = 'lastChanges';
    /**
     * @var string $filterPrefix Prefix for every filter
     */
    private $filterPrefix = 'ftr:';
    /**
     * @var string $filterPrefix Root element for filter
     */
    private $filterRootElement = 'ftr:filter';

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

        $this->constructXml();
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
     * Creates header for every XML request
     *
     * @return \SimpleXMLElement
     */
    protected function getXmlHeader()
    {
        $xmlHeader = new \SimpleXMLElement('<?xml version="1.0" encoding="Windows-1250"?>'
            . '<dat:dataPack ico="' . $this->in . '" application="HTTP klient" version="2.0" note="' .$this->getNote() . '" '
                . 'xmlns:dat="http://www.stormware.cz/schema/version_2/data.xsd" '
                . 'xmlns:stk="http://www.stormware.cz/schema/version_2/stock.xsd" '
                . 'xmlns:ftr="http://www.stormware.cz/schema/version_2/filter.xsd" '
                . 'xmlns:lStk="http://www.stormware.cz/schema/version_2/list_stock.xsd" '
                . 'xmlns:typ="http://www.stormware.cz/schema/version_2/type.xsd" id="' . $this->requestId . '">'
            . '</dat:dataPack>');

        return $xmlHeader;
    }

    /**
     * Adds DataPackItem node
     *
     * @param \SimpleXMLElement $parent
     *
     * @return \SimpleXMLElement
     */
    protected function addDataPackItem(\SimpleXMLElement $parent)
    {
        $dataPackItem = $parent->addChild('dataPackItem', null, self::DATA_NAMESPACE);
        $dataPackItem->addAttribute('id', $this->requestId);
        $dataPackItem->addAttribute('version', '2.0');

        return $dataPackItem;
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
                ->addChild('ftr:filter', null, self::FILTER_NAMESPACE);
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

        $filter->addChild($filterType, $value, self::FILTER_NAMESPACE);
    }

    /**
     * Constructs base XML
     */
    protected abstract function constructXml();

    /**
     * Returns string with XML specified for request purposes
     *
     * @return \SimpleXMLElement
     */
    public function getRequestXml()
    {
        return $this->requestXml->asXML();
    }
}