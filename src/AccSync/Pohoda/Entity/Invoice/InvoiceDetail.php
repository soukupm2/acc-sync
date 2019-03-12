<?php

namespace AccSync\Pohoda\Entity\Invoice;

use AccSync\Pohoda\Collection\Invoice\InvoiceItemsCollection;

class InvoiceDetail
{
    /**
     * @var InvoiceItemsCollection $invoiceItemsCollection
     */
    private $invoiceItemsCollection;

    /**
     * InvoiceDetail constructor.
     *
     * @param InvoiceItemsCollection $invoiceItemsCollection
     */
    public function __construct(InvoiceItemsCollection $invoiceItemsCollection)
    {
        $this->invoiceItemsCollection = $invoiceItemsCollection;
    }

    /**
     * @return InvoiceItemsCollection
     */
    public function getInvoiceItemsCollection()
    {
        return $this->invoiceItemsCollection;
    }

    /**
     * @param InvoiceItemsCollection $invoiceItemsCollection
     */
    public function setInvoiceItemsCollection(InvoiceItemsCollection $invoiceItemsCollection)
    {
        $this->invoiceItemsCollection = $invoiceItemsCollection;
    }
}