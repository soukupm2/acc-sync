<?php

namespace AccSync\Pohoda\Requests\SendDataRequest;

use AccSync\Pohoda\Collection\Invoice\InvoicesCollection;
use AccSync\Pohoda\Entity\Invoice\Invoice;
use AccSync\Pohoda\Entity\Invoice\InvoiceDetail;
use AccSync\Pohoda\Entity\Invoice\InvoiceHeader;
use AccSync\Pohoda\Entity\Invoice\InvoiceItem;
use AccSync\Pohoda\Entity\Invoice\InvoiceSummary;
use AccSync\Pohoda\Requests\BaseRequest;

class SendInvoiceRequest extends BaseRequest
{
    /**
     * @const XML Namespace for invoices
     */
    const INVOICE_NAMESPACE = 'http://www.stormware.cz/schema/version_2/invoice.xsd';

    /**
     * @var InvoicesCollection $invoicesCollection
     */
    private $invoicesCollection;

    public function __construct($requestId, $in, InvoicesCollection $invoicesCollection)
    {
        $this->invoicesCollection = $invoicesCollection;

        parent::__construct($requestId, $in);
    }

    /**
     * Constructs base XML
     */
    protected function constructXml()
    {
        if (empty($this->invoicesCollection))
        {
            throw new \InvalidArgumentException('Empty invoices collection');
        }

        $request = $this->getXmlHeader();
        $dataPackId = 1;

        /** @var Invoice $invoice */
        foreach ($this->invoicesCollection as $invoice)
        {
            $dataPackItem = $this->addDataPackItem($request, $dataPackId);

            $inv = $dataPackItem->addChild('inv:invoice', NULL, self::INVOICE_NAMESPACE);
            $inv->addAttribute('version', '2.0');

            $this->setInvoiceHeader($inv, $invoice->getInvoiceHeader());

            $this->setInvoiceDetail($inv, $invoice->getInvoiceDetail());

            $this->setInvoiceSummary($inv, $invoice->getInvoiceSummary());

            $dataPackId++;
        }

        $this->requestXml = $request;
    }

    /**
     * Sets the invoiceDetail element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param InvoiceDetail     $detail
     */
    private function setInvoiceDetail(\SimpleXMLElement $xmlRoot, InvoiceDetail $detail)
    {
        if (empty($detail))
        {
            return;
        }

        $invDetail = $xmlRoot->addChild('inv:invoiceDetail', NULL, self::INVOICE_NAMESPACE);

        /** @var InvoiceItem $item */
        foreach ($detail->getInvoiceItemsCollection() as $item)
        {
            if (!$item->isAdvancePayment())
            {
                $xmlItem = $invDetail->addChild('inv:invoiceItem', NULL, self::INVOICE_NAMESPACE);
            }
            else
            {
                $xmlItem = $invDetail->addChild('inv:invoiceAdvancePaymentItem', NULL, self::INVOICE_NAMESPACE);
            }

            if (!empty($item->getSourceDocumentNumber()))
            {
                $sourceNumber = $xmlItem->addChild('inv:sourceDocument', NULL, self::INVOICE_NAMESPACE);
                $sourceNumber->addChild('type:number', $item->getSourceDocumentNumber(), self::TYPE_NAMESPACE);
            }
            if (!empty($item->getId()))
            {
                $xmlItem->addChild('inv:id', $item->getId(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getText()))
            {
                $xmlItem->addChild('inv:text', $item->getText(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getQuantity()))
            {
                $xmlItem->addChild('inv:quantity', $item->getQuantity(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getCoefficient()))
            {
                $xmlItem->addChild('inv:coefficient', $item->getCoefficient(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getRateVAT()))
            {
                $xmlItem->addChild('inv:rateVat', $item->getRateVAT(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getGuarantee()))
            {
                $xmlItem->addChild('inv:guarantee', $item->getGuarantee(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getGuaranteeType()))
            {
                $xmlItem->addChild('inv:guaranteeType', $item->getGuaranteeType(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getDiscountPercentage()))
            {
                $xmlItem->addChild('inv:discountPercentage', $item->getDiscountPercentage(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->getHomeCurrencyPrice()) || !empty($item->getHomeCurrencyPriceSum()) || !empty($item->getHomeCurrencyPriceVAT()) || !empty($item->getHomeCurrencyUnitPrice()))
            {
                $homeCurrency = $xmlItem->addChild('inv:homeCurrency', NULL, self::INVOICE_NAMESPACE);

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
                $foreignCurrency = $xmlItem->addChild('inv:foreignCurrency', NULL, self::INVOICE_NAMESPACE);

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
                $xmlItem->addChild('inv:code', $item->getCode(), self::INVOICE_NAMESPACE);
            }
            if (!empty($item->isPDP()))
            {
                $xmlItem->addChild('inv:PDP', $item->isPDP(), self::INVOICE_NAMESPACE);
            }
        }
    }

    /**
     * Sets the invoiceSummary element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param InvoiceSummary    $summary
     */
    private function setInvoiceSummary(\SimpleXMLElement $xmlRoot, InvoiceSummary $summary)
    {
        if (empty($summary))
        {
            return;
        }

        $invSummary = $xmlRoot->addChild('inv:invoiceSummary', NULL, self::INVOICE_NAMESPACE);

        if (!empty($summary->getRoundingDocument()))
        {
            $invSummary->addChild('inv:roundingDocument', $summary->getRoundingDocument(), self::INVOICE_NAMESPACE);
        }

        $homeCurrency = $invSummary->addChild('inv:homeCurrency', NULL, self::INVOICE_NAMESPACE);

        if (!empty($summary->getPriceNone()))
        {
            $homeCurrency->addChild('typ:priceNone', $summary->getPriceNone(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceLow()))
        {
            $homeCurrency->addChild('typ:priceLow', $summary->getPriceLow(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceLowVAT()))
        {
            $homeCurrency->addChild('typ:priceLowVAT', $summary->getPriceLowVAT(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceLowSum()))
        {
            $homeCurrency->addChild('typ:priceLowSum', $summary->getPriceLowVAT(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceHigh()))
        {
            $homeCurrency->addChild('typ:priceHigh', $summary->getPriceHigh(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceHighVAT()))
        {
            $homeCurrency->addChild('typ:priceHighVAT', $summary->getPriceHighVAT(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceHighSum()))
        {
            $homeCurrency->addChild('typ:priceHighSum', $summary->getPriceHighSum(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPrice3()))
        {
            $homeCurrency->addChild('typ:price3', $summary->getPrice3(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPrice3VAT()))
        {
            $homeCurrency->addChild('typ:price3VAT', $summary->getPrice3VAT(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPrice3Sum()))
        {
            $homeCurrency->addChild('typ:price3Sum', $summary->getPrice3Sum(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getPriceRound()))
        {
            $round = $homeCurrency->addChild('typ:round', NULL, self::TYPE_NAMESPACE);
            $round->addChild('typ:round', $summary->getPriceRound(), self::TYPE_NAMESPACE);
        }

        $foreignCurrency = $invSummary->addChild('inv:foreignCurrency', NULL, self::INVOICE_NAMESPACE);

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
        if (!empty($summary->getForeignCurrencyAmount()))
        {
            $foreignCurrency->addChild('typ:amount', $summary->getForeignCurrencyAmount(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getForeignCurrencyRate()))
        {
            $foreignCurrency->addChild('typ:rate', $summary->getForeignCurrencyRate(), self::TYPE_NAMESPACE);
        }
        if (!empty($summary->getForeignCurrencyPriceSum()))
        {
            $foreignCurrency->addChild('typ:priceSum', $summary->getForeignCurrencyPriceSum(), self::TYPE_NAMESPACE);
        }
    }

    /**
     * Sets the invoiceHeader element in XML request
     *
     * @param \SimpleXMLElement $xmlRoot
     * @param InvoiceHeader     $header
     */
    private function setInvoiceHeader(\SimpleXMLElement $xmlRoot, InvoiceHeader $header)
    {
        if (empty($header))
        {
            return;
        }

        $invHeader = $xmlRoot->addChild('inv:invoiceHeader', NULL, self::INVOICE_NAMESPACE);

        if (!empty($header->getInvoiceType()))
        {
            $invHeader->addChild('inv:invoiceType', $header->getInvoiceType(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getDate()))
        {
            $invHeader->addChild('inv:date', $header->getDate(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getDateTax()))
        {
            $invHeader->addChild('inv:dateTax', $header->getDateTax(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getDateAccounting()))
        {
            $invHeader->addChild('inv:dateAccounting', $header->getDateAccounting(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getDateDue()))
        {
            $invHeader->addChild('inv:dateDue', $header->getDateDue(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getAccountingIds()))
        {
            $accounting = $invHeader->addChild('inv:accounting', NULL, self::INVOICE_NAMESPACE);
            $accounting->addChild('typ:ids', $header->getAccountingIds(), self::TYPE_NAMESPACE);
        }
        if (!empty($header->getClassificationVatIds()) || !empty($header->getClassificationVatType()))
        {
            $classificationVat = $invHeader->addChild('inv:classificationVAT', NULL, self::INVOICE_NAMESPACE);

            if (!empty($header->getClassificationVatIds()))
            {
                $classificationVat->addChild('typ:ids', $header->getClassificationVatIds(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getClassificationVatType()))
            {
                $classificationVat->addChild('typ:classificationVATType', NULL, self::TYPE_NAMESPACE);
            }
        }
        if (!empty($header->getNumberRequested()))
        {
            $number = $invHeader->addChild('inv:number', NULL, self::INVOICE_NAMESPACE);
            $number->addChild('typ:numberRequested', $header->getNumberRequested(), self::TYPE_NAMESPACE);
        }
        if (!empty($header->getText()))
        {
            $invHeader->addChild('inv:text', $header->getText(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getPaymentType()) || !empty($header->getPaymentTypeIds()))
        {
            $paymentType = $invHeader->addChild('inv:paymentType', NULL, self::INVOICE_NAMESPACE);

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
        if (!empty($header->getSymVar()))
        {
            $invHeader->addChild('inv:symVar', $header->getSymVar(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getPartnerIdentityId()))
        {
            $partnerIdentity = $invHeader->addChild('inv:paymentType', NULL, self::INVOICE_NAMESPACE);
            $partnerIdentity->addChild('typ:id', $header->getPartnerIdentityId(), self::TYPE_NAMESPACE);
        }
        elseif (!empty($header->getPartnerIdentityAddress()))
        {
            $address = $header->getPartnerIdentityAddress();

            $partnerIdentity = $invHeader->addChild('inv:paymentType', NULL, self::INVOICE_NAMESPACE);
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
        if (!empty($header->getAccountId()) || !empty($header->getAccountIds()) || !empty($header->getAccountBankCode()) || !empty($header->getAccountNo()))
        {
            $account = $invHeader->addChild('inv:account', NULL, self::INVOICE_NAMESPACE);

            if (!empty($header->getAccountId()))
            {
                $account->addChild('typ:id', $header->getAccountId(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getAccountIds()))
            {
                $account->addChild('typ:ids', $header->getAccountIds(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getAccountBankCode()))
            {
                $account->addChild('typ:bankCode', $header->getAccountBankCode(), self::TYPE_NAMESPACE);
            }
            if (!empty($header->getAccountNo()))
            {
                $account->addChild('typ:accountNo', $header->getAccountNo(), self::TYPE_NAMESPACE);
            }
        }
        if (!empty($header->getNote()))
        {
            $invHeader->addChild('inv:note', $header->getNote(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getIntNote()))
        {
            $invHeader->addChild('inv:invNote', $header->getIntNote(), self::INVOICE_NAMESPACE);
        }
        if (!empty($header->getCentreIds()))
        {
            $centre = $invHeader->addChild('inv:centre', NULL, self::INVOICE_NAMESPACE);
            $centre->addChild('typ:ids', $header->getCentreIds(), self::TYPE_NAMESPACE);
        }
        if (!empty($header->getActivityIds()))
        {
            $activity = $invHeader->addChild('inv:activity', NULL, self::INVOICE_NAMESPACE);
            $activity->addChild('typ:ids', $header->getActivityIds(), self::TYPE_NAMESPACE);
        }
    }
}