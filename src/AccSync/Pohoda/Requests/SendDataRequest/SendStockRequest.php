<?php

namespace AccSync\Pohoda\Requests\SendDataRequest;

use AccSync\Pohoda\Collection\Stock\StockCollection;
use AccSync\Pohoda\Entity\Stock\Stock;
use AccSync\Pohoda\Entity\Stock\StockHeader;
use AccSync\Pohoda\Requests\BaseRequest;

/**
 * Class SendStockRequest
 *
 * @package AccSync\Pohoda\Requests\SendDataRequest
 * @author  miroslav.soukup2@gmail.com
 */
class SendStockRequest extends BaseRequest
{
    /**
     * @var StockCollection $stockCollection
     */
    private $stockCollection;

    public function __construct($requestId, $in, StockCollection $stockCollection)
    {
        $this->stockCollection = $stockCollection;

        parent::__construct($requestId, $in);
    }

    /**
     * Constructs base XML
     */
    protected function constructXml()
    {
        if (empty($this->stockCollection))
        {
            throw new \InvalidArgumentException('Empty stock collection');
        }

        $request = $this->getXmlHeader();
        $dataPackId = 1;

        /** @var Stock $item */
        foreach ($this->stockCollection as $item)
        {
            $dataPackItem = $this->addDataPackItem($request, $dataPackId);

            $stock = $dataPackItem->addChild('stk:stock', NULL, self::STOCK_NAMESPACE);
            $stock->addAttribute('version', '2.0');

            $actionType = $stock->addChild('stk:actionType', NULL, self::STOCK_NAMESPACE);
            $actionType->addChild('stk:add', NULL, self::STOCK_NAMESPACE);

            $this->setStockHeader($stock, $item->getStockHeader());

            $dataPackId++;
        }

        $this->requestXml = $request;
    }

    /**
     * Sets the stockHeader element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param StockHeader       $header
     */
    private function setStockHeader(\SimpleXMLElement $xmlRoot, StockHeader $header)
    {
        if (empty($header))
        {
            return;
        }

        $stockHeader = $xmlRoot->addChild('stk:stockHeader', NULL, self::STOCK_NAMESPACE);

        if (!empty($header->getStockType()))
        {
            $stockHeader->addChild('stk:stockType', $header->getStockType(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getCode()))
        {
            $stockHeader->addChild('stk:code', $header->getCode(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getEan()))
        {
            $stockHeader->addChild('stk:EAN', $header->getEan(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getPLU()))
        {
            $stockHeader->addChild('stk:PLU', $header->getPLU(), self::STOCK_NAMESPACE);
        }
        if (is_bool($header->isSales()) || !empty($header->isSales()))
        {
            $stockHeader->addChild('stk:isSales', self::boolToString($header->isSales()), self::STOCK_NAMESPACE);
        }
        if (is_bool($header->isSerialNumber()) || !empty($header->isSerialNumber()))
        {
            $stockHeader->addChild('stk:isSerialNumber', self::boolToString($header->isSerialNumber()), self::STOCK_NAMESPACE);
        }
        if (is_bool($header->isInternet()) || !empty($header->isInternet()))
        {
            $stockHeader->addChild('stk:isInternet', self::boolToString($header->isInternet()), self::STOCK_NAMESPACE);
        }
        if (is_bool($header->isBatch()) || !empty($header->isBatch()))
        {
            $stockHeader->addChild('stk:isBatch', self::boolToString($header->isBatch()), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getPurchasingRateVAT()))
        {
            $stockHeader->addChild('stk:purchasingRateVAT', $header->getPurchasingRateVAT(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getSellingRateVAT()))
        {
            $stockHeader->addChild('stk:sellingRateVAT', $header->getSellingRateVAT(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getName()))
        {
            $stockHeader->addChild('stk:name', $header->getName(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getNameComplement()))
        {
            $stockHeader->addChild('stk:nameComplement', $header->getNameComplement(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getUnit()))
        {
            $stockHeader->addChild('stk:unit', $header->getUnit(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getStorageIds()) || !empty($header->getStorageId()))
        {
            $storage = $stockHeader->addChild('stk:storage', NULL, self::STOCK_NAMESPACE);

            if (!empty($header->getStorageId()))
            {
                $storage->addChild('typ:id', $header->getStorageId(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getStorageIds()))
            {
                $storage->addChild('typ:ids', $header->getStorageIds(), self::TYPE_NAMESPACE);
            }
        }
        if (!empty($header->getTypePriceId()) || !empty($header->getTypePriceIds()))
        {
            $typePrice = $stockHeader->addChild('stk:typePrice', NULL, self::STOCK_NAMESPACE);

            if (!empty($header->getTypePriceId()))
            {
                $typePrice->addChild('typ:id', $header->getTypePriceId(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getTypePriceIds()))
            {
                $typePrice->addChild('typ:ids', $header->getTypePriceIds(), self::TYPE_NAMESPACE);
            }
        }
        if ($header->getPurchasingPrice() == 0 || !empty($header->getPurchasingPrice()))
        {
            $stockHeader->addChild('stk:purchasingPrice', $header->getPurchasingPrice(), self::STOCK_NAMESPACE);
        }
        if ($header->getSellingPrice() == 0 || !empty($header->getSellingPrice()))
        {
            $stockHeader->addChild('stk:sellingPrice', $header->getSellingPrice(), self::STOCK_NAMESPACE);
        }
        if ($header->getLimitMax() == 0 || !empty($header->getLimitMax()))
        {
            $stockHeader->addChild('stk:limitMax', $header->getLimitMax(), self::STOCK_NAMESPACE);
        }
        if ($header->getLimitMin() == 0 || !empty($header->getLimitMin()))
        {
            $stockHeader->addChild('stk:limitMin', $header->getLimitMin(), self::STOCK_NAMESPACE);
        }
        if ($header->getMass() == 0 || !empty($header->getMass()))
        {
            $stockHeader->addChild('stk:mass', $header->getMass(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getSupplierId()))
        {
            $supplier = $stockHeader->addChild('stk:supplier', NULL, self::STOCK_NAMESPACE);
            $supplier->addChild('typ:id', $header->getSupplierId(), self::TYPE_NAMESPACE);
        }
        if ($header->getOrderQuantity() == 0 || !empty($header->getOrderQuantity()))
        {
            $stockHeader->addChild('stk:orderQuantity', $header->getOrderQuantity(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getShortName()))
        {
            $stockHeader->addChild('stk:shortName', $header->getShortName(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getGuaranteeType()))
        {
            $stockHeader->addChild('stk:guaranteeType', $header->getGuaranteeType(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getGuarantee()))
        {
            $stockHeader->addChild('stk:guarantee', $header->getGuarantee(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getProducer()))
        {
            $stockHeader->addChild('stk:producer', $header->getProducer(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getYield()))
        {
            $stockHeader->addChild('stk:yield', $header->getYield(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getDescription()))
        {
            $stockHeader->addChild('stk:description', $header->getDescription(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getDescription2()))
        {
            $stockHeader->addChild('stk:description2', $header->getDescription2(), self::STOCK_NAMESPACE);
        }
        if (!empty($header->getNote()))
        {
            $stockHeader->addChild('stk:note', $header->getNote(), self::STOCK_NAMESPACE);
        }
    }
}