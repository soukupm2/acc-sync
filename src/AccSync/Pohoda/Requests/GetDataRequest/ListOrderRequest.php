<?php

namespace AccSync\Pohoda\Requests\GetDataRequest;

use AccSync\Pohoda\Data\PohodaHelper;

/**
 * Class ListStockRequest
 * Orders / Objednávky
 *
 * @package AccSync\Pohoda\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class ListOrderRequest extends BaseGetDataRequest
{
    /**
     * @const Type of order: Issued
     */
    const ORDER_TYPE_ISSUED = 'issuedOrder';
    /**
     * @const Type of order: Received
     */
    const ORDER_TYPE_RECEIVED = 'receivedOrder';

    /**
     * @const Filter by date from
     */
    const FILTER_BY_DATE_FROM = 'dateFrom';
    /**
     * @const Filter by date to
     */
    const FILTER_BY_DATE_TO = 'dateTill';

    /**
     * @var string $selectedCompanies Filter name for selecting companies by name
     */
    private $selectedCompanies = 'selectedCompanys';

    /**
     * @var string $selectedCompanies Filter name for specific company
     */
    private $company = 'company';

    /**
     * @var string $selectedCompanies Filter name for selecting companies by name
     */
    private $selectedIns = 'selectedIco';
    /**
     * @var string $selectedCompanies Filter name for specific company
     */
    private $inFilter = 'ftr:ico';

    /**
     * @var string $orderType Type of order
     */
    private $orderType;

    public function __construct($requestId, $in, $orderType)
    {
        $this->orderType = $orderType;

        parent::__construct($requestId, $in);
    }

    /**
     * @inheritdoc
     */
    protected function constructXml()
    {
        $request = $this->getXmlHeader();

        $dataPackItem = $this->addDataPackItem($request);

        $listStockRequest = $dataPackItem->addChild('lst:listOrderRequest', NULL, self::LIST_NAMESPACE);
        $listStockRequest->addAttribute('version', '2.0');
        $listStockRequest->addAttribute('orderVersion', '2.0');
        $listStockRequest->addAttribute('orderType', $this->orderType);

        $requestOrder = $listStockRequest->addChild('lst:requestOrder', NULL, self::LIST_NAMESPACE);

        $this->requestXml = $request;
        $this->filterParent = $requestOrder;
    }

    /**
     * Filters orders by date range
     *
     * @param \DateTime|null $from
     * @param \DateTime|null $to
     */
    public function addFilterDateRange($from, $to)
    {
        if ((!($from instanceof \DateTime) && $from !== NULL) || (!($to instanceof \DateTime) && $to !== NULL))
        {
            throw new \InvalidArgumentException('Invalid arguments. It must be either null or DateTime');
        }
        if (!empty($from))
        {
            $this->addFilter(self::FILTER_BY_DATE_FROM, PohodaHelper::formatDate($from, FALSE));
        }
        if (!empty($to))
        {
            $this->addFilter(self::FILTER_BY_DATE_TO, PohodaHelper::formatDate($to, FALSE));
        }

        return $this;
    }

    /**
     * Filters by company names
     *
     * @param array $companies
     */
    public function addFilterCompanyName($companies)
    {
        $data = [];

        if (empty($companies))
        {
            return $this;
        }

        if (is_array($companies))
        {
            $data = $companies;
        }
        else
        {
            $data[] = $companies;
        }

        $this->addFilter($this->selectedCompanies, NULL);

        foreach ($data as $company)
        {
            $this->lastFilter->addChild($this->company, $company);
        }

        return $this;
    }

    /**
     * Filters by company identification numbers (ICO)
     *
     * @param array|int $ins
     */
    public function addFilterIns($ins)
    {
        if (empty($ins))
        {
            return $this;
        }

        $data = [];

        if (is_array($ins))
        {
            $data = $ins;
        }
        elseif (is_numeric($ins))
        {
            $data[] = $ins;
        }
        else
        {
            return $this;
        }

        $this->addFilter($this->selectedIns, NULL);

        foreach ($data as $in)
        {
            $this->lastFilter->addChild($this->inFilter, $in, self::FILTER_NAMESPACE);
        }

        return $this;
    }
}