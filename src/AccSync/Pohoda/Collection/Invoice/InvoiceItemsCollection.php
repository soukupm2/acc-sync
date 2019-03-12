<?php

namespace AccSync\Pohoda\Collection\Invoice;

use AccSync\Pohoda\Collection\BaseCollection;
use AccSync\Pohoda\Entity\Invoice\InvoiceItem;

class InvoiceItemsCollection extends BaseCollection
{
    /**
     * InvoiceItemsCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $item)
        {
            if ($item instanceof InvoiceItem)
            {
                $this->collection[] = $item;
            }
        }
    }

    /**
     * @param InvoiceItem $item
     */
    public function add(InvoiceItem $item)
    {
        $this->collection[] = $item;
    }
}