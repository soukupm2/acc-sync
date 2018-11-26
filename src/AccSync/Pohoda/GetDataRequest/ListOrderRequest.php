<?php

namespace AccSync\Pohoda\GetDataRequest;

/**
 * Class ListStockRequest
 * Orders / Objednávky
 *
 * @package AccSync\Pohoda\GetDataRequest
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
    private $in = 'ico';

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
     * Filters invoices by date range
     *
     * @param \DateTime $from
     * @param \DateTime $to
     */
    public function addFilterDateRange(\DateTime $from, \DateTime $to)
    {
        $this->addFilter(self::FILTER_BY_DATE_FROM, $from);
        $this->addFilter(self::FILTER_BY_DATE_TO, $to);
    }

    /**
     * Filters by company names
     *
     * @param array $companies
     */
    public function addFilterCompanyName(array $companies)
    {
        if (empty($companies))
        {
            return;
        }

        $parent = $this->addFilter($this->selectedCompanies, NULL);

        foreach ($companies as $company)
        {
            $parent->addChild($this->company, $company);
        }
    }

    /**
     * Filters by company identification numbers (ICO)
     *
     * @param array $ins
     */
    public function addFilterIns(array $ins)
    {
        if (empty($ins))
        {
            return;
        }

        $parent = $this->addFilter($this->selectedIns, NULL);

        foreach ($ins as $in)
        {
            $parent->addChild($this->in, $in);
        }
    }
}