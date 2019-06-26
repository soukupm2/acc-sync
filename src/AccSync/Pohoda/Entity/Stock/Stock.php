<?php

namespace AccSync\Pohoda\Entity\Stock;

use AccSync\Pohoda\Collection\Stock\StockItemPricesCollection;

/**
 * Class Stock
 *
 * @package AccSync\Pohoda\Entity\Stock
 * @author  miroslav.soukup2@gmail.com
 */
class Stock
{
    /**
     * @var StockHeader $stockHeader
     */
    private $stockHeader;
    /**
     * @var StockItemPricesCollection $stockPriceItem
     */
    private $stockPriceItem;

    /**
     * Stock constructor.
     *
     * @param null|StockHeader               $stockHeader
     * @param null|StockItemPricesCollection $stockPriceItem
     */
    public function __construct(
        StockHeader $stockHeader = NULL,
        StockItemPricesCollection $stockPriceItem = NULL)
    {
        $this->stockHeader = $stockHeader;
        $this->stockPriceItem = $stockPriceItem;
    }

    /**
     * @return StockHeader
     */
    public function getStockHeader()
    {
        return empty($this->stockHeader) ? new StockHeader() : $this->stockHeader;
    }

    /**
     * @param StockHeader $stockHeader
     */
    public function setStockHeader(StockHeader $stockHeader)
    {
        $this->stockHeader = $stockHeader;
    }

    /**
     * @return StockItemPricesCollection
     */
    public function getStockPriceItem()
    {
        return empty($this->stockPriceItem) ? new StockItemPricesCollection() : $this->stockPriceItem;
    }

    /**
     * @param StockItemPricesCollection $stockPriceItem
     */
    public function setStockPriceItem(StockItemPricesCollection $stockPriceItem)
    {
        $this->stockPriceItem = $stockPriceItem;
    }
}