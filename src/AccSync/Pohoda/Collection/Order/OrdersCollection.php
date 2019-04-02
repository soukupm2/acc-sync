<?php

namespace AccSync\Pohoda\Collection\Order;

use AccSync\Pohoda\Collection\BaseCollection;
use AccSync\Pohoda\Entity\Order\Order;

class OrdersCollection extends BaseCollection
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
            if ($item instanceof Order)
            {
                $this->collection[] = $item;
            }
        }
    }

    /**
     * Adds item into the collection
     *
     * @param Order $order
     */
    public function add(Order $order)
    {
        $this->collection[] = $order;
    }
}