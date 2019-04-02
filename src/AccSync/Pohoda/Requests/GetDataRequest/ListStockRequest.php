<?php

namespace AccSync\Pohoda\Requests\GetDataRequest;

/**
 * Class ListStockRequest
 * Supplies / Zásoby
 *
 * @package AccSync\Pohoda\GetDataRequest
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
}