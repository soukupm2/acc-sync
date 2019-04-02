<?php

namespace AccSync\Pohoda\Entity\Order;

class Order
{
    /**
     * @var OrderHeader $orderHeader
     */
    private $orderHeader;
    /**
     * @var OrderDetail $orderDetail
     */
    private $orderDetail;
    /**
     * @var OrderSummary
     */
    private $orderSummary;

    /**
     * Order constructor.
     *
     * @param OrderHeader  $orderHeader
     * @param OrderDetail  $orderDetail
     * @param OrderSummary $orderSummary
     */
    public function __construct(
        OrderHeader $orderHeader = NULL,
        OrderDetail $orderDetail = NULL,
        OrderSummary $orderSummary = NULL
    )
    {
        $this->orderHeader = $orderHeader;
        $this->orderDetail = $orderDetail;
        $this->orderSummary = $orderSummary;
    }

    /**
     * @return OrderHeader
     */
    public function getOrderHeader()
    {
        return $this->orderHeader;
    }

    /**
     * @param OrderHeader $orderHeader
     */
    public function setOrderHeader(OrderHeader $orderHeader)
    {
        $this->orderHeader = $orderHeader;
    }

    /**
     * @return OrderDetail
     */
    public function getOrderDetail()
    {
        return $this->orderDetail;
    }

    /**
     * @param OrderDetail $orderDetail
     */
    public function setOrderDetail(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * @return OrderSummary
     */
    public function getOrderSummary()
    {
        return $this->orderSummary;
    }

    /**
     * @param OrderSummary $orderSummary
     */
    public function setOrderSummary(OrderSummary $orderSummary)
    {
        $this->orderSummary = $orderSummary;
    }
}