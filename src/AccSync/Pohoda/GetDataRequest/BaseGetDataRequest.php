<?php

namespace AccSync\Pohoda\GetDataRequest;

use AccSync\Pohoda\BaseRequest;
use AccSync\Pohoda\Data\PohodaHelper;

/**
 * Class BaseGetDataRequest
 *
 * @package AccSync\Pohoda\BaseRequest
 * @author miroslav.soukup2@gmail.com
 */
abstract class BaseGetDataRequest extends BaseRequest
{
    /**
     * @const XML Namespace for filters
     */
    const FILTER_NAMESPACE = 'http://www.stormware.cz/schema/version_2/filter.xsd';
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
     * @var \SimpleXMLElement $filterParent Element, after which should be filter appended
     */
    protected $filterParent;
    /**
     * @var \SimpleXMLElement $filter Element, which contains all filter values
     */
    private $filter;

    /**
     * BaseGetDataRequest constructor.
     *
     * @param string $requestId Request ID, it is in the response for identification
     * @param string $in        Identification number of company, must be in every request
     */
    public function __construct($requestId, $in)
    {
        parent::__construct($requestId, $in);

        $this->constructXml();
    }

    /**
     * Adds filter to XML
     *
     * @param string $filterType
     * @param mixed  $value
     *
     * @return \SimpleXMLElement
     */
    public function addFilter($filterType, $value)
    {
        if ($this->filter === NULL)
        {
            $this->filter = $this->filterParent
                ->addChild($this->filterRootElement, null, self::FILTER_NAMESPACE);
        }

        if ($filterType === self::FILTER_LAST_CHANGES && $value instanceof \DateTime)
        {
            $value = PohodaHelper::formatDate($value);
        }

        if (strpos($filterType, $this->filterPrefix) === FALSE)
        {
            $filterType = $this->filterPrefix . $filterType;
        }

        $lastFilter = $this->filter->addChild($filterType, $value, self::FILTER_NAMESPACE);

        return $lastFilter;
    }
}