<?php

namespace AccSync\Pohoda\Data;

use AccSync\Pohoda\Collection\Order\OrderItemsCollection;
use AccSync\Pohoda\Collection\Order\OrdersCollection;
use AccSync\Pohoda\Entity\Address;
use AccSync\Pohoda\Entity\Order\Order;
use AccSync\Pohoda\Entity\Order\OrderDetail;
use AccSync\Pohoda\Entity\Order\OrderHeader;
use AccSync\Pohoda\Entity\Order\OrderItem;
use AccSync\Pohoda\Entity\Order\OrderSummary;

class OrderParser
{
    /**
     * @param \stdClass $data Data which was received as respose from ListInvoiceRequest request
     * @return OrdersCollection
     */
    public static function parse(\stdClass $data)
    {
        $ordersCollection = new OrdersCollection();

        if (isset($data->responsePackItem->listOrder->order))
        {
            $orders = $data->responsePackItem->listOrder->order;

            if (isset($orders->orderHeader) || isset($orders->orderDetail) || isset($orders->orderSummary))
            {
                $orderHeader = NULL;
                $orderDetail = NULL;
                $orderSummary = NULL;

                if (isset($orders->orderHeader))
                {
                    $orderHeader = self::createHeader($orders->orderHeader);
                }
                if (isset($orders->orderDetail))
                {
                    $orderDetail = self::createDetail($orders->orderDetail);
                }
                if (isset($orders->orderSummary))
                {
                    $orderSummary = self::createSummary($orders->orderSummary);
                }

                $ordersCollection->add(new Order($orderHeader, $orderDetail, $orderSummary));
            }
            else
            {
                foreach ($orders as $order)
                {
                    $orderHeader = NULL;
                    $orderDetail = NULL;
                    $orderSummary = NULL;

                    if (isset($order->orderHeader))
                    {
                        $orderHeader = self::createHeader($order->orderHeader);
                    }
                    if (isset($order->orderDetail))
                    {
                        $orderDetail = self::createDetail($order->orderDetail);
                    }
                    if (isset($order->orderSummary))
                    {
                        $orderSummary = self::createSummary($order->orderSummary);
                    }

                    $ordersCollection->add(new Order($orderHeader, $orderDetail, $orderSummary));
                }
            }
        }

        return $ordersCollection;
    }

    /**
     * @param \stdClass $orderHeader
     * @return OrderHeader
     */
    private static function createHeader(\stdClass $orderHeader)
    {
        $header = new OrderHeader();

        if (isset($orderHeader->id))
        {
            $header->setId($orderHeader->id);
        }
        if (isset($orderHeader->orderType))
        {
            $header->setOrderType($orderHeader->orderType);
        }
        if (isset($orderHeader->number->id))
        {
            $header->setNumberId($orderHeader->number->id);
        }
        if (isset($orderHeader->number->ids))
        {
            $header->setNumberIds($orderHeader->number->ids);
        }
        if (isset($orderHeader->number->numberRequested))
        {
            $header->setNumberRequested($orderHeader->number->numberRequested);
        }
        if (isset($orderHeader->date))
        {
            $header->setDate(PohodaHelper::getDate($orderHeader->date));
        }
        if (isset($orderHeader->dateFrom))
        {
            $header->setDateFrom(PohodaHelper::getDate($orderHeader->dateFrom));
        }
        if (isset($orderHeader->dateTo))
        {
            $header->setDateTo(PohodaHelper::getDate($orderHeader->dateTo));
        }
        if (isset($orderHeader->text))
        {
            $header->setText($orderHeader->text);
        }
        if (isset($orderHeader->partnerIdentity))
        {
            if (isset($orderHeader->partnerIdentity->id))
            {
                $header->setPartnerIdentityId($orderHeader->partnerIdentity->id);
            }

            $header->setPartnerIdentityAddress(self::setHeaderAddress($orderHeader->partnerIdentity));
        }
        if (isset($orderHeader->myIdentity))
        {
            $header->setMyIdentityAddress(self::setHeaderAddress($orderHeader->myIdentity));
        }
        if (isset($orderHeader->paymentType->id))
        {
            $header->setPaymentTypeId($orderHeader->paymentType->id);
        }
        if (isset($orderHeader->paymentType->ids))
        {
            $header->setPaymentTypeIds($orderHeader->paymentType->ids);
        }
        if (isset($orderHeader->paymentType->paymentType))
        {
            $header->setPaymentType($orderHeader->paymentType->paymentType);
        }
        if (isset($orderHeader->isExecuted))
        {
            $header->setIsExecuted($orderHeader->isExecuted);
        }
        if (isset($orderHeader->isDelivered))
        {
            $header->setIsDelivered($orderHeader->isDelivered);
        }
        if (isset($orderHeader->isReserved))
        {
            $header->setIsReserved($orderHeader->isReserved);
        }
        if (isset($orderHeader->permanentDocument))
        {
            $header->setIsPermanentDocument($orderHeader->permanentDocument);
        }
        if (isset($orderHeader->markRecord))
        {
            $header->setMarkRecord($orderHeader->markRecord);
        }

        return $header;
    }

    private static function setHeaderAddress(\stdClass $data)
    {
        $address = new Address();

        if (isset($data->address))
        {
            if (isset($data->address->company))
            {
                $address->setCompany($data->address->company);
            }
            if (isset($data->address->division))
            {
                $address->setDivision($data->address->division);
            }
            if (isset($data->address->name))
            {
                $name = $data->address->name;

                if (isset($data->address->surname))
                {
                    $name .= ' ' . $data->address->surname;
                }

                $address->setName($name);
            }
            if (isset($data->address->city))
            {
                $address->setCity($data->address->city);
            }
            if (isset($data->address->street))
            {
                $address->setStreet($data->address->street);
            }
            if (isset($data->address->zip))
            {
                $address->setZip($data->address->zip);
            }
            if (isset($data->address->ico))
            {
                $address->setIco($data->address->ico);
            }
            if (isset($data->address->dic))
            {
                $address->setDic($data->address->dic);
            }
            if (isset($data->address->phone))
            {
                $address->setPhone($data->address->phone);
            }
            if (isset($data->address->mobilPhone))
            {
                $address->setMobilPhone($data->address->mobilPhone);
            }
            if (isset($data->address->fax))
            {
                $address->setFax($data->address->fax);
            }
            if (isset($data->address->email))
            {
                $address->setEmail($data->address->email);
            }
            if (isset($data->address->www))
            {
                $address->setWww($data->address->www);
            }
        }
        if (isset($data->shipToAddress))
        {
            if (isset($data->shipToAddress->company))
            {
                $address->setShipToCompany($data->shipToAddress->company);
            }
            if (isset($data->shipToAddress->name))
            {
                $address->setShipToName($data->shipToAddress->company);
            }
            if (isset($data->shipToAddress->city))
            {
                $address->setShipToCity($data->shipToAddress->city);
            }
            if (isset($data->shipToAddress->street))
            {
                $address->setShipToStreet($data->shipToAddress->street);
            }
            if (isset($data->shipToAddress->phone))
            {
                $address->setShipToPhone($data->shipToAddress->phone);
            }
            if (isset($data->shipToAddress->zip))
            {
                $address->setShipToZip($data->shipToAddress->zip);
            }
        }

        return $address;
    }

    /**
     * @param \stdClass $orderDetail
     * @return OrderDetail
     */
    private static function createDetail(\stdClass $orderDetail)
    {
        $detail = new OrderDetail();
        $orderItemsCollection = new OrderItemsCollection();

        foreach ($orderDetail->orderItem as $item)
        {
            $orderItem = new OrderItem();

            if (isset($item->id))
            {
                $orderItem->setId($item->id);
            }
            if (isset($item->text))
            {
                $orderItem->setText($item->text);
            }
            if (isset($item->quantity))
            {
                $orderItem->setQuantity($item->quantity);
            }
            if (isset($item->delivered))
            {
                $orderItem->setDelivered($item->delivered);
            }
            if (isset($item->unit))
            {
                $orderItem->setUnit($item->unit);
            }
            if (isset($item->coefficient))
            {
                $orderItem->setCoefficient($item->coefficient);
            }
            if (isset($item->payVAT))
            {
                $orderItem->setPayVAT($item->payVAT);
            }
            if (isset($item->rateVAT))
            {
                $orderItem->setRateVAT($item->rateVAT);
            }
            if (isset($item->discountPercentage))
            {
                $orderItem->setDiscountPercentage($item->discountPercentage);
            }
            if (isset($item->homeCurrency->unitPrice))
            {
                $orderItem->setHomeCurrencyUnitPrice($item->homeCurrency->unitPrice);
            }
            if (isset($item->homeCurrency->price))
            {
                $orderItem->setHomeCurrencyPrice($item->homeCurrency->price);
            }
            if (isset($item->homeCurrency->priceVAT))
            {
                $orderItem->setHomeCurrencyPriceVAT($item->homeCurrency->priceVAT);
            }
            if (isset($item->homeCurrency->priceSum))
            {
                $orderItem->setHomeCurrencyPriceSum($item->homeCurrency->priceSum);
            }
            if (isset($item->foreignCurrency->unitPrice))
            {
                $orderItem->setForeignCurrencyUnitPrice($item->foreignCurrency->unitPrice);
            }
            if (isset($item->foreignCurrency->price))
            {
                $orderItem->setForeignCurrencyPrice($item->foreignCurrency->price);
            }
            if (isset($item->foreignCurrency->priceVAT))
            {
                $orderItem->setForeignCurrencyPriceVAT($item->foreignCurrency->priceVAT);
            }
            if (isset($item->foreignCurrency->priceSum))
            {
                $orderItem->setForeignCurrencyPriceSum($item->foreignCurrency->priceSum);
            }
            if (isset($item->code))
            {
                $orderItem->setCode($item->code);
            }
            if (isset($item->stockItem->store->id))
            {
                $orderItem->setStoreId($item->stockItem->store->id);
            }
            if (isset($item->stockItem->store->ids))
            {
                $orderItem->setStoreIds($item->stockItem->store->ids);
            }
            if (isset($item->stockItem->stockItem->id))
            {
                $orderItem->setStockItemId($item->stockItem->stockItem->id);
            }
            if (isset($item->stockItem->stockItem->ids))
            {
                $orderItem->setStockItemIds($item->stockItem->stockItem->ids);
            }
            if (isset($item->stockItem->stockItem->PLU))
            {
                $orderItem->setStockItemPLU($item->stockItem->stockItem->PLU);
            }

            $orderItemsCollection->add($orderItem);
        }

        $detail->setOrderItemsCollection($orderItemsCollection);

        return $detail;
    }

    /**
     * @param \stdClass $orderSummary
     * @return OrderSummary
     */
    private static function createSummary(\stdClass $orderSummary)
    {
        $summary = new OrderSummary();

        if (isset($orderSummary->roundingDocument))
        {
            $summary->setRoundingDocument($orderSummary->roundingDocument);
        }
        if (isset($orderSummary->roundingVAT))
        {
            $summary->setRoundingVat($orderSummary->roundingVAT);
        }
        if (isset($orderSummary->calculateVAT))
        {
            $summary->setCalculateVat($orderSummary->calculateVAT);
        }
        if (isset($orderSummary->homeCurrency->priceNone))
        {
            $summary->setPriceNone($orderSummary->homeCurrency->priceNone);
        }
        if (isset($orderSummary->homeCurrency->priceLow))
        {
            $summary->setPriceLow($orderSummary->homeCurrency->priceLow);
        }
        if (isset($orderSummary->homeCurrency->priceLowVAT))
        {
            $summary->setPriceLowVAT($orderSummary->homeCurrency->priceLowVAT);
        }
        if (isset($orderSummary->homeCurrency->priceLowSum))
        {
            $summary->setPriceLowSum($orderSummary->homeCurrency->priceLowSum);
        }
        if (isset($orderSummary->homeCurrency->priceHigh))
        {
            $summary->setPriceHigh($orderSummary->homeCurrency->priceHigh);
        }
        if (isset($orderSummary->homeCurrency->priceHighVAT))
        {
            $summary->setPriceHighVAT($orderSummary->homeCurrency->priceHighVAT);
        }
        if (isset($orderSummary->homeCurrency->priceHighSum))
        {
            $summary->setPriceHighSum($orderSummary->homeCurrency->priceHighSum);
        }
        if (isset($orderSummary->homeCurrency->round->priceRound))
        {
            $summary->setPriceRound($orderSummary->homeCurrency->round->priceRound);
        }
        if (isset($orderSummary->foreignCurrency->currency->id))
        {
            $summary->setForeignCurrencyId($orderSummary->foreignCurrency->currency->id);
        }
        if (isset($orderSummary->foreignCurrency->currency->ids))
        {
            $summary->setForeignCurrencyIds($orderSummary->foreignCurrency->currency->ids);
        }
        if (isset($orderSummary->foreignCurrency->rate))
        {
            $summary->setForeignCurrencyRate($orderSummary->foreignCurrency->rate);
        }
        if (isset($orderSummary->foreignCurrency->amount))
        {
            $summary->setForeignCurrencyAmount($orderSummary->foreignCurrency->amount);
        }
        if (isset($orderSummary->foreignCurrency->priceSum))
        {
            $summary->setForeignCurrencyPriceSum($orderSummary->foreignCurrency->priceSum);
        }

        return $summary;
    }
}