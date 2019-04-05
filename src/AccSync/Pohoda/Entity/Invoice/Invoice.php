<?php

namespace AccSync\Pohoda\Entity\Invoice;

/**
 * Class Invoice
 *
 * @package AccSync\Pohoda\Entity\Invoice
 * @author  miroslav.soukup2@gmail.com
 */
class Invoice
{
    /**
     * @var InvoiceHeader $invoiceHeader Invoice header part
     */
    private $invoiceHeader;
    /**
     * @var InvoiceDetail $invoiceDetail Invoice detail part
     */
    private $invoiceDetail;
    /**
     * @var InvoiceSummary $invoiceSummary Invoice summary part
     */
    private $invoiceSummary;

    /**
     * Invoice constructor.
     *
     * @param InvoiceHeader  $invoiceHeader
     * @param InvoiceDetail  $invoiceDetail
     * @param InvoiceSummary $invoiceSummary
     */
    public function __construct(
        InvoiceHeader $invoiceHeader = NULL,
        InvoiceDetail $invoiceDetail = NULL,
        InvoiceSummary $invoiceSummary= NULL
    )
    {
        $this->invoiceHeader = $invoiceHeader;
        $this->invoiceDetail = $invoiceDetail;
        $this->invoiceSummary = $invoiceSummary;
    }

    /**
     * @return InvoiceHeader
     */
    public function getInvoiceHeader()
    {
        return $this->invoiceHeader;
    }

    /**
     * @param InvoiceHeader $invoiceHeader
     */
    public function setInvoiceHeader(InvoiceHeader $invoiceHeader)
    {
        $this->invoiceHeader = $invoiceHeader;
    }

    /**
     * @return InvoiceDetail
     */
    public function getInvoiceDetail()
    {
        return $this->invoiceDetail;
    }

    /**
     * @param InvoiceDetail $invoiceDetail
     */
    public function setInvoiceDetail(InvoiceDetail $invoiceDetail)
    {
        $this->invoiceDetail = $invoiceDetail;
    }

    /**
     * @return InvoiceSummary
     */
    public function getInvoiceSummary()
    {
        return $this->invoiceSummary;
    }

    /**
     * @param InvoiceSummary $invoiceSummary
     */
    public function setInvoiceSummary(InvoiceSummary $invoiceSummary)
    {
        $this->invoiceSummary = $invoiceSummary;
    }
}