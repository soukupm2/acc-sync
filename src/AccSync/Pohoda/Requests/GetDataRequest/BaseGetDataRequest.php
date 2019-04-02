<?php

namespace AccSync\Pohoda\Requests\GetDataRequest;

use AccSync\Pohoda\Data\PohodaHelper;
use AccSync\Pohoda\Requests\BaseRequest;

/**
 * Class BaseGetDataRequest
 *
 * @package AccSync\Pohoda\Requests\GetDataRequest
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
    protected $filter;
    /**
     * @var \SimpleXMLElement $lastFilter Contains last filter added (so children could be appended)
     */
    protected $lastFilter;

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

        $this->lastFilter = $this->filter->addChild($filterType, $value, self::FILTER_NAMESPACE);

        return $this;
    }
}