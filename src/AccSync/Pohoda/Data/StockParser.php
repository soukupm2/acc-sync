<?php

namespace AccSync\Pohoda\Data;

use AccSync\Pohoda\Collection\Stock\StockCollection;
use AccSync\Pohoda\Collection\Stock\StockItemPricesCollection;
use AccSync\Pohoda\Entity\Stock\Stock;
use AccSync\Pohoda\Entity\Stock\StockHeader;
use AccSync\Pohoda\Entity\Stock\StockPrice;

/**
 * Class StockParser
 *
 * @package AccSync\Pohoda\Data
 * @author  miroslav.soukup2@gmail.com
 */
class StockParser
{
    /**
     * @param \stdClass $data
     * @return StockCollection|null
     */
    public static function parse(\stdClass $data)
    {
        $stockCollection = new StockCollection();

        if (isset($data->responsePackItem->listStock->stock))
        {
            $stock = $data->responsePackItem->listStock->stock;

            if (isset($stock->stockHeader) || isset($stock->stockPriceItem))
            {
                $stockHeader = NULL;
                $stockPriceItem = NULL;

                if (isset($stock->stockHeader))
                {
                    $stockHeader = self::createHeader($stock->stockHeader);
                }
                if (isset($stock->stockPriceItem))
                {
                    $stockPriceItem = self::createStockPriceItem($stock->stockPriceItem);
                }

                $stockCollection->add(new Stock($stockHeader, $stockPriceItem));
            }
            else
            {
                foreach ($stock as $item)
                {
                    $stockHeader = NULL;
                    $stockPriceItem = NULL;

                    if (isset($item->stockHeader))
                    {
                        $stockHeader = self::createHeader($item->stockHeader);
                    }
                    if (isset($item->stockPriceItem))
                    {
                        $stockPriceItem = self::createStockPriceItem($item->stockPriceItem);
                    }

                    $stockCollection->add(new Stock($stockHeader, $stockPriceItem));
                }
            }
        }
        else
        {
            return NULL;
        }

        return $stockCollection;
    }

    /**
     * @param \stdClass $stockHeader
     * @return StockHeader
     */
    private static function createHeader(\stdClass $stockHeader)
    {
        $header = new StockHeader();

        if (isset($stockHeader->id))
        {
            $header->setId($stockHeader->id);
        }
        if (isset($stockHeader->stockType))
        {
            $header->setStockType($stockHeader->stockType);
        }
        if (isset($stockHeader->code))
        {
            $header->setCode($stockHeader->code);
        }
        if (isset($stockHeader->PLU))
        {
            $header->setPLU($stockHeader->PLU);
        }
        if (isset($stockHeader->isSales))
        {
            $header->setIsSales($stockHeader->isSales);
        }
        if (isset($stockHeader->isSerialNumber))
        {
            $header->setIsSerialNumber($stockHeader->isSerialNumber);
        }
        if (isset($stockHeader->isInternet))
        {
            $header->setIsInternet($stockHeader->isInternet);
        }
        if (isset($stockHeader->isBatch))
        {
            $header->setIsBatch($stockHeader->isBatch);
        }
        if (isset($stockHeader->purchasingRateVAT))
        {
            $header->setPurchasingRateVAT($stockHeader->purchasingRateVAT);
        }
        if (isset($stockHeader->sellingRateVAT))
        {
            $header->setSellingRateVAT($stockHeader->sellingRateVAT);
        }
        if (isset($stockHeader->name))
        {
            $header->setName($stockHeader->name);
        }
        if (!empty($stockHeader->nameComplement))
        {
            $header->setNameComplement($stockHeader->name);
        }
        if (isset($stockHeader->unit))
        {
            $header->setUnit($stockHeader->unit);
        }
        if (isset($stockHeader->storage->id))
        {
            $header->setStorageId($stockHeader->storage->id);
        }
        if (isset($stockHeader->storage->ids))
        {
            $header->setStorageIds($stockHeader->storage->ids);
        }
        if (isset($stockHeader->typePrice->id))
        {
            $header->setTypePriceId($stockHeader->typePrice->id);
        }
        if (isset($stockHeader->typePrice->ids))
        {
            $header->setTypePriceIds($stockHeader->typePrice->ids);
        }
        if (isset($stockHeader->weightedPurchasePrice))
        {
            $header->setWeightedPurchasePrice($stockHeader->weightedPurchasePrice);
        }
        if (isset($stockHeader->purchasingPrice))
        {
            $header->setPurchasingPrice($stockHeader->purchasingPrice);
        }
        if (isset($stockHeader->sellingPrice))
        {
            $header->setSellingPrice($stockHeader->sellingPrice);
        }
        if (isset($stockHeader->count))
        {
            $header->setCount($stockHeader->count);
        }
        if (isset($stockHeader->countReceivedOrders))
        {
            $header->setCountReceivedOrders($stockHeader->countReceivedOrders);
        }
        if (isset($stockHeader->reservation))
        {
            $header->setReservation($stockHeader->reservation);
        }
        if (isset($stockHeader->reclamation))
        {
            $header->setReclamation($stockHeader->reclamation);
        }
        if (isset($stockHeader->orderQuantity))
        {
            $header->setOrderQuantity($stockHeader->orderQuantity);
        }
        if (isset($stockHeader->countIssuedOrders))
        {
            $header->setCountIssuedOrders($stockHeader->countIssuedOrders);
        }
        if (isset($stockHeader->guaranteeType))
        {
            $header->setGuaranteeType($stockHeader->guaranteeType);
        }
        if (isset($stockHeader->guarantee))
        {
            $header->setGuarantee($stockHeader->guarantee);
        }
        if (isset($stockHeader->producer))
        {
            $header->setProducer($stockHeader->producer);
        }
        if (isset($stockHeader->news))
        {
            $header->setNews($stockHeader->news);
        }
        if (isset($stockHeader->clearanceSale))
        {
            $header->setClearanceSale($stockHeader->clearanceSale);
        }
        if (isset($stockHeader->sale))
        {
            $header->setSale($stockHeader->sale);
        }
        if (isset($stockHeader->recommended))
        {
            $header->setRecommended($stockHeader->recommended);
        }
        if (isset($stockHeader->discount))
        {
            $header->setDiscount($stockHeader->discount);
        }
        if (isset($stockHeader->prepare))
        {
            $header->setPrepare($stockHeader->prepare);
        }
        if (isset($stockHeader->controlLimitTaxLiability))
        {
            $header->setControlLimitTaxLiability($stockHeader->controlLimitTaxLiability);
        }
        if (isset($stockHeader->description))
        {
            $header->setDescription($stockHeader->description);
        }
        if (isset($stockHeader->description2))
        {
            $header->setDescription2($stockHeader->description2);
        }
        if (isset($stockHeader->markRecord))
        {
            $header->setMarkRecord($stockHeader->markRecord);
        }

        return $header;
    }

    /**
     * @param \stdClass $stockPriceItem
     * @return StockItemPricesCollection
     */
    private static function createStockPriceItem(\stdClass $stockPriceItem)
    {
        $stockItemPricesCollection = new StockItemPricesCollection();

        if (is_countable($stockPriceItem->stockPrice))
        {
            foreach ($stockPriceItem->stockPrice as $price)
            {
                $stockPrice = self::setStockPriceItem($price);

                $stockItemPricesCollection->add($stockPrice);
            }
        }
        elseif (isset($stockPriceItem->stockPrice))
        {
            $stockPrice = self::setStockPriceItem($stockPriceItem->stockPrice);

            $stockItemPricesCollection->add($stockPrice);
        }

        return $stockItemPricesCollection;
    }

    /**
     * @param \stdClass $item
     * @return StockPrice
     */
    private static function setStockPriceItem(\stdClass $item)
    {
        $stockPrice = new StockPrice();

        if (isset($item->id))
        {
            $stockPrice->setId($item->id);
        }
        if (isset($item->ids))
        {
            $stockPrice->setIds($item->ids);
        }
        if (isset($item->price))
        {
            $stockPrice->setPrice($item->price);
        }

        return $stockPrice;
    }
}