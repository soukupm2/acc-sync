<?php

namespace AccSync\Pohoda\Data;

use AccSync\Pohoda\Collection\Invoice\InvoiceItemsCollection;
use AccSync\Pohoda\Collection\Invoice\InvoicesCollection;
use AccSync\Pohoda\Entity\Address;
use AccSync\Pohoda\Entity\Invoice\Invoice;
use AccSync\Pohoda\Entity\Invoice\InvoiceDetail;
use AccSync\Pohoda\Entity\Invoice\InvoiceHeader;
use AccSync\Pohoda\Entity\Invoice\InvoiceItem;
use AccSync\Pohoda\Entity\Invoice\InvoiceSummary;

/**
 * Class InvoiceParser
 *
 * @package AccSync\Pohoda\Data
 * @author  miroslav.soukup2@gmail.com
 */
class InvoiceParser
{
    /**
     * @param \stdClass $data Data which was received as respose from ListInvoiceRequest request
     * @return InvoicesCollection
     */
    public static function parse(\stdClass $data)
    {
        $invoicesCollection = new InvoicesCollection();

        if (isset($data->responsePackItem->listInvoice->invoice))
        {
            $invoices = $data->responsePackItem->listInvoice->invoice;

            if (isset($invoices->invoiceHeader) || isset($invoices->invoiceDetail) || isset($invoices->invoiceSummary))
            {
                $invoiceHeader = NULL;
                $invoiceDetail = NULL;
                $invoiceSummary = NULL;

                if (isset($invoices->invoiceHeader))
                {
                    $invoiceHeader = self::createHeader($invoices->invoiceHeader);
                }
                if (isset($invoices->invoiceDetail))
                {
                    $invoiceDetail = self::createDetail($invoices->invoiceDetail);
                }
                if (isset($invoices->invoiceSummary))
                {
                    $invoiceSummary = self::createSummary($invoices->invoiceSummary);
                }

                $invoicesCollection->add(new Invoice($invoiceHeader, $invoiceDetail, $invoiceSummary));
            }
            else
            {
                foreach ($invoices as $invoice)
                {
                    $invoiceHeader = NULL;
                    $invoiceDetail = NULL;
                    $invoiceSummary = NULL;

                    if (isset($invoice->invoiceHeader))
                    {
                        $invoiceHeader = self::createHeader($invoice->invoiceHeader);
                    }
                    if (isset($invoice->invoiceDetail))
                    {
                        $invoiceDetail = self::createDetail($invoice->invoiceDetail);
                    }
                    if (isset($invoice->invoiceSummary))
                    {
                        $invoiceSummary = self::createSummary($invoice->invoiceSummary);
                    }

                    $invoicesCollection->add(new Invoice($invoiceHeader, $invoiceDetail, $invoiceSummary));
                }
            }
        }

        return $invoicesCollection;
    }

    /**
     * @param \stdClass $invoiceHeader
     * @return InvoiceHeader
     */
    private static function createHeader(\stdClass $invoiceHeader)
    {
        $header = new InvoiceHeader();

        if (isset($invoiceHeader->id))
        {
            $header->setId($invoiceHeader->id);
        }
        if (isset($invoiceHeader->invoiceType))
        {
            $header->setInvoiceType($invoiceHeader->invoiceType);
        }
        if (isset($invoiceHeader->number->numberRequested))
        {
            $header->setNumberRequested($invoiceHeader->number->numberRequested);
        }
        if (isset($invoiceHeader->date))
        {
            $header->setDate(PohodaHelper::getDate($invoiceHeader->date));
        }
        if (isset($invoiceHeader->dateTax))
        {
            $header->setDateTax(PohodaHelper::getDate($invoiceHeader->dateTax));
        }
        if (isset($invoiceHeader->dateAccounting))
        {
            $header->setDateAccounting(PohodaHelper::getDate($invoiceHeader->dateAccounting));
        }
        if (isset($invoiceHeader->dateDue))
        {
            $header->setDateDue(PohodaHelper::getDate($invoiceHeader->dateDue));
        }
        if (isset($invoiceHeader->accounting->id))
        {
            $header->setAccountingId($invoiceHeader->accounting->id);
        }
        if (isset($invoiceHeader->accounting->ids))
        {
            $header->setAccountingIds($invoiceHeader->accounting->ids);
        }
        if (isset($invoiceHeader->classificationVAT->id))
        {
            $header->setClassificationVatId($invoiceHeader->classificationVAT->id);
        }
        if (isset($invoiceHeader->classificationVAT->ids))
        {
            $header->setClassificationVatIds($invoiceHeader->classificationVAT->ids);
        }
        if (isset($invoiceHeader->classificationVAT->classificationVATType))
        {
            $header->setClassificationVatType($invoiceHeader->classificationVAT->classificationVATType);
        }
        if (isset($invoiceHeader->text))
        {
            $header->setText($invoiceHeader->text);
        }
        if (isset($invoiceHeader->partnerIdentity))
        {
            if (isset($invoiceHeader->partnerIdentity->id))
            {
                $header->setPartnerIdentityId($invoiceHeader->partnerIdentity->id);
            }

            $header->setPartnerIdentityAddress(self::setHeaderAddress($invoiceHeader->partnerIdentity));
        }
        if (isset($invoiceHeader->myIdentity))
        {
            $header->setMyIdentityAddress(self::setHeaderAddress($invoiceHeader->myIdentity));
        }
        if (isset($invoiceHeader->paymentType->id))
        {
            $header->setPaymentTypeId($invoiceHeader->paymentType->id);
        }
        if (isset($invoiceHeader->paymentType->ids))
        {
            $header->setPaymentTypeIds($invoiceHeader->paymentType->ids);
        }
        if (isset($invoiceHeader->paymentType->paymentType))
        {
            $header->setPaymentType($invoiceHeader->paymentType->paymentType);
        }
        if (isset($invoiceHeader->account->id))
        {
            $header->setAccountId($invoiceHeader->account->id);
        }
        if (isset($invoiceHeader->account->ids))
        {
            $header->setAccountIds($invoiceHeader->account->ids);
        }
        if (isset($invoiceHeader->account->accountNo))
        {
            $header->setAccountNo($invoiceHeader->account->accountNo);
        }
        if (isset($invoiceHeader->account->bankCode))
        {
            $header->setAccountBankCode($invoiceHeader->account->bankCode);
        }
        if (isset($invoiceHeader->symConst))
        {
            $header->setSymConst($invoiceHeader->symConst);
        }
        if (isset($invoiceHeader->contract->id))
        {
            $header->setContractId($invoiceHeader->contract->id);
        }
        if (isset($invoiceHeader->contract->ids))
        {
            $header->setContractIds($invoiceHeader->contract->ids);
        }
        if (isset($invoiceHeader->liquidation->amountHome))
        {
            $header->setLiquidationAmountHome($invoiceHeader->liquidation->amountHome);
        }
        if (isset($invoiceHeader->liquidation->amountForeign))
        {
            $header->setLiquidationAmountForeign($invoiceHeader->liquidation->amountForeign);
        }
        if (isset($invoiceHeader->markRecord))
        {
            $header->setMarkRecord($invoiceHeader->markRecord);
        }
        if (isset($invoiceHeader->note))
        {
            $header->setNote($invoiceHeader->note);
        }
        if (isset($invoiceHeader->note))
        {
            $header->setNote($invoiceHeader->note);
        }
        if (isset($invoiceHeader->intNote))
        {
            $header->setIntNote($invoiceHeader->intNote);
        }
        if (isset($invoiceHeader->centre->ids))
        {
            $header->setCentreIds($invoiceHeader->centre->ids);
        }
        if (isset($invoiceHeader->activity->ids))
        {
            $header->setActivityIds($invoiceHeader->activity->ids);
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
     * @param \stdClass $invoiceDetail
     * @return InvoiceDetail
     */
    private static function createDetail(\stdClass $invoiceDetail)
    {
        $detail = new InvoiceDetail();
        $invoiceItemsCollection = new InvoiceItemsCollection();

        foreach ($invoiceDetail->invoiceItem as $item)
        {
            $invoiceItem = new InvoiceItem();

            if (isset($item->id))
            {
                $invoiceItem->setId($item->id);
            }
            if (isset($item->text))
            {
                $invoiceItem->setText($item->text);
            }
            if (isset($item->quantity))
            {
                $invoiceItem->setQuantity($item->quantity);
            }
            if (isset($item->unit))
            {
                $invoiceItem->setUnit($item->unit);
            }
            if (isset($item->coefficient))
            {
                $invoiceItem->setCoefficient($item->coefficient);
            }
            if (isset($item->payVAT))
            {
                $invoiceItem->setPayVAT($item->payVAT);
            }
            if (isset($item->rateVAT))
            {
                $invoiceItem->setRateVAT($item->rateVAT);
            }
            if (isset($item->discountPercentage))
            {
                $invoiceItem->setDiscountPercentage($item->discountPercentage);
            }
            if (isset($item->homeCurrency->unitPrice))
            {
                $invoiceItem->setHomeCurrencyUnitPrice($item->homeCurrency->unitPrice);
            }
            if (isset($item->homeCurrency->price))
            {
                $invoiceItem->setHomeCurrencyPrice($item->homeCurrency->price);
            }
            if (isset($item->homeCurrency->priceVAT))
            {
                $invoiceItem->setHomeCurrencyPriceVAT($item->homeCurrency->priceVAT);
            }
            if (isset($item->homeCurrency->priceSum))
            {
                $invoiceItem->setHomeCurrencyPriceSum($item->homeCurrency->priceSum);
            }
            if (isset($item->foreignCurrency->unitPrice))
            {
                $invoiceItem->setForeignCurrencyUnitPrice($item->foreignCurrency->unitPrice);
            }
            if (isset($item->foreignCurrency->price))
            {
                $invoiceItem->setForeignCurrencyPrice($item->foreignCurrency->price);
            }
            if (isset($item->foreignCurrency->priceVAT))
            {
                $invoiceItem->setForeignCurrencyPriceVAT($item->foreignCurrency->priceVAT);
            }
            if (isset($item->foreignCurrency->priceSum))
            {
                $invoiceItem->setForeignCurrencyPriceSum($item->foreignCurrency->priceSum);
            }
            if (isset($item->code))
            {
                $invoiceItem->setCode($item->code);
            }
            if (isset($item->guarantee))
            {
                $invoiceItem->setGuarantee($item->guarantee);
            }
            if (isset($item->guaranteeType))
            {
                $invoiceItem->setGuaranteeType($item->guaranteeType);
            }
            if (isset($item->stockItem->store->id))
            {
                $invoiceItem->setStoreId($item->stockItem->store->id);
            }
            if (isset($item->stockItem->store->ids))
            {
                $invoiceItem->setStoreIds($item->stockItem->store->ids);
            }
            if (isset($item->stockItem->stockItem->id))
            {
                $invoiceItem->setStockItemId($item->stockItem->stockItem->id);
            }
            if (isset($item->stockItem->stockItem->ids))
            {
                $invoiceItem->setStockItemIds($item->stockItem->stockItem->ids);
            }
            if (isset($item->stockItem->stockItem->PLU))
            {
                $invoiceItem->setStockItemPLU($item->stockItem->stockItem->PLU);
            }
            if (isset($item->stockItem->serialNumber))
            {
                $invoiceItem->setSerialNumber($item->stockItem->serialNumber);
            }
            if (isset($item->PDP))
            {
                $invoiceItem->setPDP($item->PDP);
            }
            if (isset($item->sourceDocument->number))
            {
                $invoiceItem->setSourceDocumentNumber($item->sourceDocument->number);
            }

            $invoiceItemsCollection->add($invoiceItem);
        }

        $detail->setInvoiceItemsCollection($invoiceItemsCollection);

        return $detail;
    }

    /**
     * @param \stdClass $invoiceSummary
     * @return InvoiceSummary
     */
    private static function createSummary(\stdClass $invoiceSummary)
    {
        $summary = new InvoiceSummary();

        if (isset($invoiceSummary->roundingDocument))
        {
            $summary->setRoundingDocument($invoiceSummary->roundingDocument);
        }
        if (isset($invoiceSummary->roundingVAT))
        {
            $summary->setRoundingVat($invoiceSummary->roundingVAT);
        }
        if (isset($invoiceSummary->calculateVAT))
        {
            $summary->setCalculateVat($invoiceSummary->calculateVAT);
        }
        if (isset($invoiceSummary->homeCurrency->priceNone))
        {
            $summary->setPriceNone($invoiceSummary->homeCurrency->priceNone);
        }
        if (isset($invoiceSummary->homeCurrency->priceLow))
        {
            $summary->setPriceLow($invoiceSummary->homeCurrency->priceLow);
        }
        if (isset($invoiceSummary->homeCurrency->priceLowVAT))
        {
            $summary->setPriceLowVAT($invoiceSummary->homeCurrency->priceLowVAT);
        }
        if (isset($invoiceSummary->homeCurrency->priceLowSum))
        {
            $summary->setPriceLowSum($invoiceSummary->homeCurrency->priceLowSum);
        }
        if (isset($invoiceSummary->homeCurrency->priceHigh))
        {
            $summary->setPriceHigh($invoiceSummary->homeCurrency->priceHigh);
        }
        if (isset($invoiceSummary->homeCurrency->priceHighVAT))
        {
            $summary->setPriceHighVAT($invoiceSummary->homeCurrency->priceHighVAT);
        }
        if (isset($invoiceSummary->homeCurrency->priceHighSum))
        {
            $summary->setPriceHighSum($invoiceSummary->homeCurrency->priceHighSum);
        }
        if (isset($invoiceSummary->homeCurrency->price3))
        {
            $summary->setPrice3($invoiceSummary->homeCurrency->price3);
        }
        if (isset($invoiceSummary->homeCurrency->price3VAT))
        {
            $summary->setPrice3VAT($invoiceSummary->homeCurrency->price3VAT);
        }
        if (isset($invoiceSummary->homeCurrency->price3Sum))
        {
            $summary->setPrice3Sum($invoiceSummary->homeCurrency->price3Sum);
        }
        if (isset($invoiceSummary->homeCurrency->round->priceRound))
        {
            $summary->setPriceRound($invoiceSummary->homeCurrency->round->priceRound);
        }
        if (isset($invoiceSummary->foreignCurrency->currency->id))
        {
            $summary->setForeignCurrencyId($invoiceSummary->foreignCurrency->currency->id);
        }
        if (isset($invoiceSummary->foreignCurrency->currency->ids))
        {
            $summary->setForeignCurrencyIds($invoiceSummary->foreignCurrency->currency->ids);
        }
        if (isset($invoiceSummary->foreignCurrency->rate))
        {
            $summary->setForeignCurrencyRate($invoiceSummary->foreignCurrency->rate);
        }
        if (isset($invoiceSummary->foreignCurrency->amount))
        {
            $summary->setForeignCurrencyAmount($invoiceSummary->foreignCurrency->amount);
        }
        if (isset($invoiceSummary->foreignCurrency->priceSum))
        {
            $summary->setForeignCurrencyPriceSum($invoiceSummary->foreignCurrency->priceSum);
        }

        return $summary;
    }
}