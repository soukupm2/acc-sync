<?php

namespace AccSync\Pohoda\Entity\Order;

use AccSync\Pohoda\Collection\Order\OrderItemsCollection;

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