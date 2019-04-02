<?php

namespace AccSync\Pohoda\Collection\Order;

use AccSync\Pohoda\Collection\BaseCollection;
use AccSync\Pohoda\Entity\Order\OrderItem;

class OrderItemsCollection extends BaseCollection
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
            if ($item instanceof OrderItem)
            {
                $this->collection[] = $item;
            }
        }
    }

    /**
     * @param OrderItem $item
     */
    public function add(OrderItem $item)
    {
        $this->collection[] = $item;
    }
}