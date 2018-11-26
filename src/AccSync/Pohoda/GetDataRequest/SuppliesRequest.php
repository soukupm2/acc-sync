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
    public function getRequestXml()
    {
        $request = $this->getXmlHeader();

        $dataPackItem = $this->addDataPackItem($request);

        $listStockRequest = $dataPackItem->addChild('lStk:listStockRequest');
        $listStockRequest->addAttribute('version', '2.0');
        $listStockRequest->addAttribute('stockVersion', '2.0');

        $requestStock = $listStockRequest->addChild('lStk:requestStock');

        $this->requestXml = $request;
        $this->filterParent = $requestStock;

        return $request;
    }
}