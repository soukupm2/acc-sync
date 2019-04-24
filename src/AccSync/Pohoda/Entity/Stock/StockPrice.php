<?php

namespace AccSync\Pohoda\Entity\Stock;

/**
 * Class StockPrice
 *
 * @package AccSync\Pohoda\Entity\Stock
 * @author  miroslav.soukup2@gmail.com
 */
class StockPrice
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $ids
     */
    private $ids;
    /**
     * @var float $price
     */
    private $price;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param string $ids
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}