<?php

namespace AccSync\Pohoda\GetDataRequest;


class SuppliesRequest extends BaseGetDataRequest
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
     * @inheritdoc
     */
    protected function constructXml()
    {
        $request = $this->getXmlHeader();

        $dataPackItem = $this->addDataPackItem($request);

        $listStockRequest = $dataPackItem->addChild('listStockRequest', NULL, self::LIST_STOCK_NAMESPACE);
        $listStockRequest->addAttribute('version', '2.0');
        $listStockRequest->addAttribute('stockVersion', '2.0');

        $requestStock = $listStockRequest->addChild('requestStock', NULL, self::LIST_STOCK_NAMESPACE);

        $this->requestXml = $request;
        $this->filterParent = $requestStock;
    }
}