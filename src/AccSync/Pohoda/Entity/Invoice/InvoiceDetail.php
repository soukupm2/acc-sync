<?php

namespace AccSync\Pohoda\Entity\Invoice;

use AccSync\Pohoda\Collection\Invoice\InvoiceItemsCollection;

/**
 * Class InvoiceDetail
 *
 * @package AccSync\Pohoda\Entity\Invoice
 * @author  miroslav.soukup2@gmail.com
 */
class InvoiceDetail
{
    /**
     * @var InvoiceItemsCollection $invoiceItemsCollection
     */
    private $invoiceItemsCollection;

    /**
     * @return InvoiceItemsCollection
     */
    public function getInvoiceItemsCollection()
    {
        return empty($this->invoiceItemsCollection) ? new InvoiceItemsCollection() : $this->invoiceItemsCollection;
    }

    /**
     * @param InvoiceItemsCollection $invoiceItemsCollection
     */
    public function setInvoiceItemsCollection(InvoiceItemsCollection $invoiceItemsCollection)
    {
        $this->invoiceItemsCollection = $invoiceItemsCollection;
    }
}