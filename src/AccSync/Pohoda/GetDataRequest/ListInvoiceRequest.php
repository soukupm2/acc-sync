<?php

namespace AccSync\Pohoda\GetDataRequest;

use AccSync\Pohoda\Data\PohodaHelper;

/**
 * Class ListStockRequest
 * Invoices / Faktury
 *
 * @package AccSync\Pohoda\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class ListInvoiceRequest extends BaseGetDataRequest
{
    /**
     * @const Filter by date from
     */
    const FILTER_BY_DATE_FROM = 'dateFrom';
    /**
     * @const Filter by date to
     */
    const FILTER_BY_DATE_TO = 'dateTill';

    /**
     * @const Type of order: Issued
     */
    const INVOICE_TYPE_ISSUED = 'issuedInvoice';

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
    private $inFilter = 'ico';

    /**
     * @var string $invoiceType Type of invoice
     */
    private $invoiceType;

    public function __construct($requestId, $in, $invoiceType)
    {
        $this->invoiceType = $invoiceType;

        parent::__construct($requestId, $in);
    }

    /**
     * @inheritdoc
     */
    protected function constructXml()
    {
        $request = $this->getXmlHeader();

        $dataPackItem = $this->addDataPackItem($request);

        $listStockRequest = $dataPackItem->addChild('lst:listInvoiceRequest', NULL, self::LIST_NAMESPACE);
        $listStockRequest->addAttribute('version', '2.0');
        $listStockRequest->addAttribute('invoiceVersion', '2.0');
        $listStockRequest->addAttribute('invoiceType', $this->invoiceType);

        $requestInvoice = $listStockRequest->addChild('lst:requestInvoice', NULL, self::LIST_NAMESPACE);

        $this->requestXml = $request;
        $this->filterParent = $requestInvoice;
    }

    /**
     * Filters invoices by date range
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
            $parent->addChild($this->inFilter, $in);
        }
    }
}