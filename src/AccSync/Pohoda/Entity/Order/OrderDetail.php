<?php

namespace AccSync\Pohoda\Entity\Order;

use AccSync\Pohoda\Collection\Order\OrderItemsCollection;

/**
 * Class OrderDetail
 *
 * @package AccSync\Pohoda\Entity\Order
 * @author  miroslav.soukup2@gmail.com
 */
class OrderDetail
{
    /**
     * @var OrderItemsCollection
     */
    private $orderItemsCollection;

    /**
     * @return OrderItemsCollection
     */
    public function getOrderItemsCollection()
    {
        return $this->orderItemsCollection;
    }

    /**
     * @param OrderItemsCollection $orderItemsCollection
     */
    public function setOrderItemsCollection(OrderItemsCollection $orderItemsCollection)
    {
        $this->orderItemsCollection = $orderItemsCollection;
    }
}