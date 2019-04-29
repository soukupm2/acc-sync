<?php

namespace AccSync\Pohoda\Requests;

/**
 * Class BaseRequest
 *
 * @package AccSync\Pohoda\Requests
 * @author  miroslav.soukup2@gmail.com
 */
abstract class BaseRequest
{
    /**
     * @const XML Namespace for data
     */
    const DATA_NAMESPACE = 'http://www.stormware.cz/schema/version_2/data.xsd';
    /**
     * @const XML Namespace for stock
     */
    const STOCK_NAMESPACE = 'http://www.stormware.cz/schema/version_2/stock.xsd';
    /**
     * @const XML Namespace for list stock
     */
    const LIST_NAMESPACE = 'http://www.stormware.cz/schema/version_2/list.xsd';
    /**
     * @const XML Namespace for list stock
     */
    const LIST_STOCK_NAMESPACE = 'http://www.stormware.cz/schema/version_2/list_stock.xsd';
    /**
     * @const XML Namespace for type
     */
    const TYPE_NAMESPACE = 'http://www.stormware.cz/schema/version_2/type.xsd';

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
     * @param string $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        $this->constructXml();

        return $this;
    }

    /**
     * @param string $in
     */
    public function setIn($in)
    {
        $this->in = $in;

        $this->constructXml();

        return $this;
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
            . 'xmlns:dat="' . self::DATA_NAMESPACE . '" '
            . 'xmlns:stk="' . self::STOCK_NAMESPACE . '" '
            . 'xmlns:lStk="' . self::LIST_STOCK_NAMESPACE . '" '
            . 'xmlns:lst="' . self::LIST_NAMESPACE . '" '
            . 'xmlns:typ="' . self::TYPE_NAMESPACE . '"  id="' . $this->requestId . '">'
            . '</dat:dataPack>');

        return $xmlHeader;
    }

    /**
     * Adds DataPackItem node
     *
     * @param \SimpleXMLElement $parent
     * @param int|null          $customId
     *
     * @return \SimpleXMLElement
     */
    protected function addDataPackItem(\SimpleXMLElement $parent, $customId = NULL)
    {
        $dataPackItem = $parent->addChild('dat:dataPackItem');
        if (!empty($customId))
        {
            $dataPackItem->addAttribute('id', $customId);
        }
        else
        {
            $dataPackItem->addAttribute('id', $this->requestId);
        }
        $dataPackItem->addAttribute('version', '2.0');

        return $dataPackItem;
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
        return $this->requestXml;
    }

    /**
     * Option to insert custom XML
     *
     * @param \SimpleXMLElement $xml
     */
    public function setCustomXml(\SimpleXMLElement $xml)
    {
        $this->requestXml = $xml;
    }

    /**
     * @param bool $var
     * @return string
     */
    protected static function boolToString($var)
    {
        return $var ? 'true' : 'false';
    }
}