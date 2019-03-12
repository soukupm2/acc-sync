<?php

namespace AccSync\Pohoda\Collection\Invoice;

use AccSync\Pohoda\Collection\BaseCollection;
use AccSync\Pohoda\Entity\Invoice\Invoice;

class InvoicesCollection extends BaseCollection
{
    /**
     * InvoicesCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $item)
        {
            if ($item instanceof Invoice)
            {
                $this->collection[] = $item;
            }
        }
    }

    /**
     * Adds item into the collection
     *
     * @param Invoice $invoice
     */
    public function add(Invoice $invoice)
    {
        $this->collection[] = $invoice;
    }
}