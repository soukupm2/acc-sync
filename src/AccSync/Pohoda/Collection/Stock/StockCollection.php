<?php

namespace AccSync\Pohoda\Collection\Stock;

use AccSync\Pohoda\Collection\BaseCollection;
use AccSync\Pohoda\Entity\Stock\Stock;

class StockCollection extends BaseCollection
{
    /**
     * StockCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $item)
        {
            if ($item instanceof Stock)
            {
                $this->collection[] = $item;
            }
        }
    }

    /**
     * Adds item into the collection
     *
     * @param Stock $stock
     */
    public function add(Stock $stock)
    {
        $this->collection[] = $stock;
    }
}