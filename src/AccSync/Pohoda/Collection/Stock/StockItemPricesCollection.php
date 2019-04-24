<?php

namespace AccSync\Pohoda\Collection\Stock;

use AccSync\Pohoda\Collection\BaseCollection;
use AccSync\Pohoda\Entity\Stock\StockPrice;

/**
 * Class StockItemPricesCollection
 *
 * @package AccSync\Pohoda\Collection\Stock
 * @author  miroslav.soukup2@gmail.com
 */
class StockItemPricesCollection extends BaseCollection
{
    /**
     * StockItemPricesCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $item)
        {
            if ($item instanceof StockPrice)
            {
                $this->collection[] = $item;
            }
        }
    }

    /**
     * Adds item into the collection
     *
     * @param StockPrice $stockPrice
     */
    public function add(StockPrice $stockPrice)
    {
        $this->collection[] = $stockPrice;
    }
}