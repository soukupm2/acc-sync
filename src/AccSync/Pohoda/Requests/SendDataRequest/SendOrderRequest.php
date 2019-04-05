<?php

namespace AccSync\Pohoda\Requests\SendDataRequest;

use AccSync\Pohoda\Collection\Order\OrdersCollection;
use AccSync\Pohoda\Entity\Order\Order;
use AccSync\Pohoda\Entity\Order\OrderDetail;
use AccSync\Pohoda\Entity\Order\OrderHeader;
use AccSync\Pohoda\Entity\Order\OrderItem;
use AccSync\Pohoda\Entity\Order\OrderSummary;
use AccSync\Pohoda\Requests\BaseRequest;

/**
 * Class SendOrderRequest
 *
 * @package AccSync\Pohoda\Requests\SendDataRequest
 * @author  miroslav.soukup2@gmail.com
 */
class SendOrderRequest extends BaseRequest
{
    /**
     * @const XML Namespace for invoices
     */
    const ORDER_NAMESPACE = 'http://www.stormware.cz/schema/version_2/order.xsd';

    /**
     * @var OrdersCollection $ordersCollection
     */
    private $ordersCollection;

    public function __construct($requestId, $in, OrdersCollection $ordersCollection)
    {
        $this->ordersCollection = $ordersCollection;

        parent::__construct($requestId, $in);
    }

    /**
     * Constructs base XML
     */
    protected function constructXml()
    {
        if (empty($this->ordersCollection))
        {
            throw new \InvalidArgumentException('Empty orders collection');
        }

        $request = $this->getXmlHeader();
        $dataPackId = 1;

        /** @var Order $order */
        foreach ($this->ordersCollection as $order)
        {
            $dataPackItem = $this->addDataPackItem($request, $dataPackId);

            $inv = $dataPackItem->addChild('ord:order', NULL, self::ORDER_NAMESPACE);
            $inv->addAttribute('version', '2.0');

            $this->setOrderHeader($inv, $order->getOrderHeader());

            $this->setOrderDetail($inv, $order->getOrderDetail());

            $this->setOrderSummary($inv, $order->getOrderSummary());

            $dataPackId++;
        }

        $this->requestXml = $request;
    }

    /**
     * Sets the orderHeader element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param OrderHeader     $header
     */
    private function setOrderHeader(\SimpleXMLElement $xmlRoot, OrderHeader $header)
    {
        if (empty($header))
        {
            return;
        }

        $ordHeader = $xmlRoot->addChild('ord:orderHeader', NULL, self::ORDER_NAMESPACE);

        if (!empty($header->getOrderType()))
        {
            $ordHeader->addChild('ord:orderType', $header->getOrderType(), self::ORDER_NAMESPACE);
        }
        if (!empty($header->getNumberId()) || !empty($header->getNumberIds()) || !empty($header->getNumberRequested()))
        {
            $number = $ordHeader->addChild('ord:number', NULL, self::ORDER_NAMESPACE);
            
            if (!empty($header->getNumberId()))
            {
                $number->addChild('ord:id', $header->getNumberId(), self::ORDER_NAMESPACE);
            }
            if (!empty($header->getNumberIds()))
            {
                $number->addChild('ord:ids', $header->getNumberIds(), self::ORDER_NAMESPACE);
            }
            if (!empty($header->getNumberRequested()))
            {
                $number->addChild('ord:numberRequested', $header->getNumberRequested(), self::ORDER_NAMESPACE);
            }
        }
        if (!empty($header->getDate()))
        {
            $ordHeader->addChild('ord:date', $header->getDate(), self::ORDER_NAMESPACE);
        }
        if (!empty($header->getDateFrom()))
        {
            $ordHeader->addChild('ord:dateFrom', $header->getDateFrom(), self::ORDER_NAMESPACE);
        }
        if (!empty($header->getDateTo()))
        {
            $ordHeader->addChild('ord:dateTo', $header->getDateTo(), self::ORDER_NAMESPACE);
        }
        if (!empty($header->getText()))
        {
            $ordHeader->addChild('ord:text', $header->getText(), self::ORDER_NAMESPACE);
        }
        if (!empty($header->getNumberRequested()))
        {
            $number = $ordHeader->addChild('ord:number', NULL, self::ORDER_NAMESPACE);
            $number->addChild('typ:numberRequested', $header->getNumberRequested(), self::TYPE_NAMESPACE);
        }
        if (!empty($header->getText()))
        {
            $ordHeader->addChild('ord:text', $header->getText(), self::ORDER_NAMESPACE);
        }
        if (!empty($header->getPaymentType()) || !empty($header->getPaymentTypeIds()))
        {
            $paymentType = $ordHeader->addChild('ord:paymentType', NULL, self::ORDER_NAMESPACE);

            if (!empty($header->getPaymentType()))
            {
                $paymentType->addChild('typ:paymentType', $header->getPaymentType(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getPaymentTypeIds()))
            {
                $paymentType->addChild('typ:ids', $header->getPaymentTypeIds(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getPaymentTypeId()))
            {
                $paymentType->addChild('typ:id', $header->getPaymentTypeId(), self::TYPE_NAMESPACE);
            }
        }
        if (!empty($header->getPriceLevelId()) || !empty($header->getPriceLevelIds()))
        {
            $priceLevel = $ordHeader->addChild('ord:priceLevel', NULL, self::ORDER_NAMESPACE);

            if (!empty($header->getPriceLevelId()))
            {
                $priceLevel->addChild('typ:id', $header->getPriceLevelId(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getPriceLevelIds()))
            {
                $priceLevel->addChild('typ:ids', $header->getPriceLevelIds(), self::TYPE_NAMESPACE);
            }
        }
        if (!empty($header->getPartnerIdentityId()))
        {
            $partnerIdentity = $ordHeader->addChild('ord:paymentType', NULL, self::ORDER_NAMESPACE);
            $partnerIdentity->addChild('typ:id', $header->getPartnerIdentityId(), self::TYPE_NAMESPACE);
        }
        elseif (!empty($header->getPartnerIdentityAddress()))
        {
            $address = $header->getPartnerIdentityAddress();

            $partnerIdentity = $ordHeader->addChild('ord:paymentType', NULL, self::ORDER_NAMESPACE);
            $addressXml = $partnerIdentity->addChild('typ:address', NULL, self::TYPE_NAMESPACE);
            $shippingAddressXml = $partnerIdentity->addChild('typ:shipToAddress', NULL, self::TYPE_NAMESPACE);

            if (!empty($address->getCompany()))
            {
                $addressXml->addChild('typ:company', $address->getCompany(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getDivision()))
            {
                $addressXml->addChild('typ:division', $address->getDivision(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getName()))
            {
                $addressXml->addChild('typ:name', $address->getName(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getCity()))
            {
                $addressXml->addChild('typ:city', $address->getCity(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getStreet()))
            {
                $addressXml->addChild('typ:street', $address->getStreet(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getZip()))
            {
                $addressXml->addChild('typ:zip', $address->getZip(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getIco()))
            {
                $addressXml->addChild('typ:ico', $address->getIco(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getDic()))
            {
                $addressXml->addChild('typ:dic', $address->getDic(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getPhone()))
            {
                $addressXml->addChild('typ:phone', $address->getPhone(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getMobilPhone()))
            {
                $addressXml->addChild('typ:mobilPhone', $address->getMobilPhone(), self::TYPE_NAMESPACE);
            }

            if (!empty($address->getShipToName()))
            {
                $shippingAddressXml->addChild('typ:name', $address->getShipToName(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getShipToCompany()))
            {
                $shippingAddressXml->addChild('typ:company', $address->getShipToCompany(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getShipToCity()))
            {
                $shippingAddressXml->addChild('typ:city', $address->getShipToCity(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getShipToZip()))
            {
                $shippingAddressXml->addChild('typ:zip', $address->getShipToZip(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getShipToStreet()))
            {
                $shippingAddressXml->addChild('typ:street', $address->getShipToStreet(), self::TYPE_NAMESPACE);
            }
            if (!empty($address->getShipToPhone()))
            {
                $shippingAddressXml->addChild('typ:phone', $address->getShipToPhone(), self::TYPE_NAMESPACE);
            }
        }
        if (is_bool($header->isExecuted()) || !empty($header->isExecuted()))
        {
            $ordHeader->addChild('ord:isExecuted', $header->isExecuted(), self::ORDER_NAMESPACE);
        }
        if (is_bool($header->isDelivered()) || !empty($header->isDelivered()))
        {
            $ordHeader->addChild('ord:isDelivered', $header->isDelivered(), self::ORDER_NAMESPACE);
        }
        if (is_bool($header->isReserved()) || !empty($header->isReserved()))
        {
            $ordHeader->addChild('ord:isReserved', $header->isReserved(), self::ORDER_NAMESPACE);
        }
        if (is_bool($header->isPermanentDocument()) || !empty($header->isPermanentDocument()))
        {
            $ordHeader->addChild('ord:permanentDocument', $header->isPermanentDocument(), self::ORDER_NAMESPACE);
        }
        if (is_bool($header->isMarkRecord()) || !empty($header->isMarkRecord()))
        {
            $ordHeader->addChild('ord:markRecord', $header->isMarkRecord(), self::ORDER_NAMESPACE);
        }
    }

    /**
     * Sets the invoiceDetail element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param OrderDetail     $detail
     */
    private function setOrderDetail(\SimpleXMLElement $xmlRoot, OrderDetail $detail)
    {
        if (empty($detail))
        {
            return;
        }

        $orderDetail = $xmlRoot->addChild('ord:orderDetail', NULL, self::ORDER_NAMESPACE);

        /** @var OrderItem $item */
        foreach ($detail->getOrderItemsCollection() as $item)
        {
            $xmlItem = $orderDetail->addChild('ord:orderItem', NULL, self::ORDER_NAMESPACE);

            if (!empty($item->getId()))
            {
                $xmlItem->addChild('ord:id', $item->getId(), self::ORDER_NAMESPACE);
            }
            if (!empty($item->getText()))
            {
                $xmlItem->addChild('ord:text', $item->getText(), self::ORDER_NAMESPACE);
            }
            if ($item->getQuantity() == 0 || !empty($item->getQuantity()))
            {
                $xmlItem->addChild('ord:quantity', $item->getQuantity(), self::ORDER_NAMESPACE);
            }
            if ($item->getDelivered() == 0 || !empty($item->getDelivered()))
            {
                $xmlItem->addChild('ord:delivered', $item->getDelivered(), self::ORDER_NAMESPACE);
            }
            if (!empty($item->getUnit()))
            {
                $xmlItem->addChild('ord:unit', $item->getUnit(), self::ORDER_NAMESPACE);
            }
            if ($item->getCoefficient() == 0 || !empty($item->getCoefficient()))
            {
                $xmlItem->addChild('ord:coefficient', $item->getCoefficient(), self::ORDER_NAMESPACE);
            }
            if (!empty($item->getRateVAT()))
            {
                $xmlItem->addChild('ord:rateVat', $item->getRateVAT(), self::ORDER_NAMESPACE);
            }
            if (is_bool($item->isPayVAT()) || !empty($item->isPayVAT()))
            {
                $xmlItem->addChild('ord:payVat', $item->isPayVAT(), self::ORDER_NAMESPACE);
            }
            if ($item->getDiscountPercentage() == 0 || !empty($item->getDiscountPercentage()))
            {
                $xmlItem->addChild('ord:discountPercentage', $item->getDiscountPercentage(), self::ORDER_NAMESPACE);
            }
            if (!empty($item->getHomeCurrencyPrice()) || !empty($item->getHomeCurrencyPriceSum()) || !empty($item->getHomeCurrencyPriceVAT()) || !empty($item->getHomeCurrencyUnitPrice()))
            {
                $homeCurrency = $xmlItem->addChild('ord:homeCurrency', NULL, self::ORDER_NAMESPACE);

                if (!empty($item->getHomeCurrencyPrice()))
                {
                    $homeCurrency->addChild('typ:price', $item->getHomeCurrencyPrice(), self::TYPE_NAMESPACE);
                }
                if (!empty($item->getHomeCurrencyPriceSum()))
                {
                    $homeCurrency->addChild('typ:priceSum', $item->getHomeCurrencyPriceSum(), self::TYPE_NAMESPACE);
                }
                if (!empty($item->getHomeCurrencyPriceVAT()))
                {
                    $homeCurrency->addChild('typ:priceVAT', $item->getHomeCurrencyPriceVAT(), self::TYPE_NAMESPACE);
                }
                if (!empty($item->getHomeCurrencyUnitPrice()))
                {
                    $homeCurrency->addChild('typ:unitPrice', $item->getHomeCurrencyUnitPrice(), self::TYPE_NAMESPACE);
                }
            }
            if (!empty($item->getForeignCurrencyPrice()) || !empty($item->getForeignCurrencyPriceSum()) || !empty($item->getForeignCurrencyPriceVAT()) || !empty($item->getForeignCurrencyUnitPrice()))
            {
                $foreignCurrency = $xmlItem->addChild('ord:foreignCurrency', NULL, self::ORDER_NAMESPACE);

                if (!empty($item->getForeignCurrencyPrice()))
                {
                    $foreignCurrency->addChild('typ:price', $item->getForeignCurrencyPrice(), self::TYPE_NAMESPACE);
                }
                if (!empty($item->getForeignCurrencyPriceSum()))
                {
                    $foreignCurrency->addChild('typ:priceSum', $item->getForeignCurrencyPriceSum(), self::TYPE_NAMESPACE);
                }
                if (!empty($item->getForeignCurrencyPriceVAT()))
                {
                    $foreignCurrency->addChild('typ:priceVAT', $item->getForeignCurrencyPriceVAT(), self::TYPE_NAMESPACE);
                }
                if (!empty($item->getForeignCurrencyUnitPrice()))
                {
                    $foreignCurrency->addChild('typ:unitPrice', $item->getForeignCurrencyUnitPrice(), self::TYPE_NAMESPACE);
                }
            }
            if (!empty($item->getCode()))
            {
                $xmlItem->addChild('ord:code', $item->getCode(), self::ORDER_NAMESPACE);
            }
            if (!empty($item->isPDP()))
            {
                $xmlItem->addChild('ord:PDP', $item->isPDP(), self::ORDER_NAMESPACE);
            }
            if (!empty($item->getStoreId()) || !empty($item->getStoreIds()) || !empty($item->getStockItemId()) || !empty($item->getStockItemIds()) || !empty($item->getStockItemPLU()))
            {
                $stockItem = $xmlItem->addChild('ord:stockItem', NULL, self::ORDER_NAMESPACE);

                if (!empty($item->getStoreId()) || !empty($item->getStoreIds()))
                {
                    $store = $stockItem->addChild('typ:store', NULL, self::TYPE_NAMESPACE);

                    if (!empty($item->getStoreId()))
                    {
                        $store->addChild('typ:id', $item->getStoreId(), self::TYPE_NAMESPACE);
                    }
                    if (!empty($item->getStoreIds()))
                    {
                        $store->addChild('typ:ids', $item->getStoreIds(), self::TYPE_NAMESPACE);
                    }
                }

                if (!empty($item->getStockItemId()) || !empty($item->getStockItemIds()) || !empty($item->getStockItemPLU()))
                {
                    $stockItemTyp = $stockItem->addChild('typ:stockItem', NULL, self::TYPE_NAMESPACE);

                    if (!empty($item->getStockItemId()))
                    {
                        $stockItemTyp->addChild('typ:id', $item->getStockItemId(), self::TYPE_NAMESPACE);
                    }
                    if (!empty($item->getStockItemIds()))
                    {
                        $stockItemTyp->addChild('typ:ids', $item->getStockItemIds(), self::TYPE_NAMESPACE);
                    }
                    if (!empty($item->getStockItemPLU()))
                    {
                        $stockItemTyp->addChild('typ:PLU', $item->getStockItemPLU(), self::TYPE_NAMESPACE);
                    }
                }
            }
        }
    }

    /**
     * Sets the invoiceSummary element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param OrderSummary    $summary
     */
    private function setOrderSummary(\SimpleXMLElement $xmlRoot, OrderSummary $summary)
    {
        if (empty($summary))
        {
            return;
        }

        $invSummary = $xmlRoot->addChild('ord:orderSummary', NULL, self::ORDER_NAMESPACE);

        if (!empty($summary->getRoundingDocument()))
        {
            $invSummary->addChild('ord:roundingDocument', $summary->getRoundingDocument(), self::ORDER_NAMESPACE);
        }

        $homeCurrency = $invSummary->addChild('ord:homeCurrency', NULL, self::ORDER_NAMESPACE);

        if ($summary->getPriceNone() == 0 || !empty($summary->getPriceNone()))
        {
            $homeCurrency->addChild('typ:priceNone', $summary->getPriceNone(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceLow() == 0 || !empty($summary->getPriceLow()))
        {
            $homeCurrency->addChild('typ:priceLow', $summary->getPriceLow(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceLowVAT() == 0 || !empty($summary->getPriceLowVAT()))
        {
            $homeCurrency->addChild('typ:priceLowVAT', $summary->getPriceLowVAT(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceLowSum() == 0 || !empty($summary->getPriceLowSum()))
        {
            $homeCurrency->addChild('typ:priceLowSum', $summary->getPriceLowVAT(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceHigh() == 0 || !empty($summary->getPriceHigh()))
        {
            $homeCurrency->addChild('typ:priceHigh', $summary->getPriceHigh(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceHighVAT() == 0 || !empty($summary->getPriceHighVAT()))
        {
            $homeCurrency->addChild('typ:priceHighVAT', $summary->getPriceHighVAT(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceHighSum() == 0 || !empty($summary->getPriceHighSum()))
        {
            $homeCurrency->addChild('typ:priceHighSum', $summary->getPriceHighSum(), self::TYPE_NAMESPACE);
        }
        if ($summary->getPriceRound() == 0 || !empty($summary->getPriceRound()))
        {
            $round = $homeCurrency->addChild('typ:round', NULL, self::TYPE_NAMESPACE);
            $round->addChild('typ:round', $summary->getPriceRound(), self::TYPE_NAMESPACE);
        }

        $foreignCurrency = $invSummary->addChild('ord:foreignCurrency', NULL, self::ORDER_NAMESPACE);

        if (!empty($summary->getForeignCurrencyIds()) || !empty($summary->getForeignCurrencyId()))
        {
            $currency = $foreignCurrency->addChild('typ:currency', NULL, self::TYPE_NAMESPACE);

            if (!empty($summary->getForeignCurrencyId()))
            {
                $currency->addChild('typ:id', $summary->getForeignCurrencyId(), self::TYPE_NAMESPACE);
            }
            if (!empty($summary->getForeignCurrencyIds()))
            {
                $currency->addChild('typ:ids', $summary->getForeignCurrencyIds(), self::TYPE_NAMESPACE);
            }
        }
        if ($summary->getForeignCurrencyAmount() == 0 || !empty($summary->getForeignCurrencyAmount()))
        {
            $foreignCurrency->addChild('typ:amount', $summary->getForeignCurrencyAmount(), self::TYPE_NAMESPACE);
        }
        if ($summary->getForeignCurrencyRate() == 0 || !empty($summary->getForeignCurrencyRate()))
        {
            $foreignCurrency->addChild('typ:rate', $summary->getForeignCurrencyRate(), self::TYPE_NAMESPACE);
        }
        if ($summary->getForeignCurrencyPriceSum() == 0 || !empty($summary->getForeignCurrencyPriceSum()))
        {
            $foreignCurrency->addChild('typ:priceSum', $summary->getForeignCurrencyPriceSum(), self::TYPE_NAMESPACE);
        }
    }
}