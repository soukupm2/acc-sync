<?php

namespace AccSync\Pohoda\Requests\GetDataRequest;

use AccSync\Pohoda\Data\PohodaHelper;

/**
 * Class ListStockRequest
 * Supplies / Zásoby
 *
 * @package AccSync\Pohoda\Requests\GetDataRequest
 * @author miroslav.soukup2@gmail.com
 */
class ListStockRequest extends BaseGetDataRequest
{
    /**
     * @const Filter by supply code
     */
    const FILTER_BY_SUPPLY_CODE = 'code';
    /**
     * @const Filter by store
     */
    const FILTER_BY_STORE = 'store';
    /**
     * @const Filter by store division
     */
    const FILTER_BY_STORE_DIVISION = 'storage';
    /**
     * @const Filter by has internet
     */
    const FILTER_BY_STORE_INTERNET = 'internet';
    /**
     * @var string $ftrStoreIds
     */
    private $ftrStoreIds = 'store';
    /**
     * @var string $ftrStorageIds
     */
    private $ftrStorageIds = 'storage';
    /**
     * @var string $ftrStorageIds
     */
    private $ftrLastChanges = 'lastChanges';
    /**
     * @var string $ftrTypeIds
     */
    private $ftrTypeIds = 'typ:ids';

    /**
     * @inheritdoc
     */
    protected function constructXml()
    {
        $request = $this->getXmlHeader();

        $dataPackItem = $this->addDataPackItem($request);

        $listStockRequest = $dataPackItem->addChild('lStk:listStockRequest', NULL, self::LIST_STOCK_NAMESPACE);
        $listStockRequest->addAttribute('version', '2.0');
        $listStockRequest->addAttribute('stockVersion', '2.0');

        $requestStock = $listStockRequest->addChild('lStk:requestStock', NULL, self::LIST_STOCK_NAMESPACE);

        $this->requestXml = $request;
        $this->filterParent = $requestStock;
    }

    /**
     * Filters by store IDs
     *
     * @param array $storeIds
     */
    public function addFilterStoreIds(array $storeIds)
    {
        if (empty($ins))
        {
            return $this;
        }

        $this->addFilter($this->ftrStoreIds, NULL);

        foreach ($storeIds as $id)
        {
            $this->lastFilter->addChild($this->ftrTypeIds, $id, self::TYPE_NAMESPACE);
        }

        return $this;
    }

    /**
     * Filters by store division IDs
     *
     * @param array $storageDivisions
     */
    public function addFilterStorageDivision(array $storageDivisions)
    {
        if (empty($ins))
        {
            return $this;
        }

        $this->addFilter($this->ftrStorageIds, NULL);

        foreach ($storageDivisions as $id)
        {
            $this->lastFilter->addChild($this->ftrTypeIds, $id, self::TYPE_NAMESPACE);
        }

        return $this;
    }

    /**
     * Filters invoices by date range
     *
     * @param \DateTime $lastChanges
     */
    public function addFilterLastChanges(\DateTime $lastChanges)
    {
        $this->addFilter($this->ftrLastChanges, PohodaHelper::formatDate($lastChanges));

        return $this;
    }
}