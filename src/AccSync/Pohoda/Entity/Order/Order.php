<?php

namespace AccSync\Pohoda\Entity\Order;

/**
 * Class Order
 *
 * @package AccSync\Pohoda\Entity\Order
 * @author  miroslav.soukup2@gmail.com
 */
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
        return empty($this->orderHeader) ? new OrderHeader() : $this->orderHeader;
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
        return empty($this->orderDetail) ? new OrderDetail() : $this->orderDetail;
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
        return empty($this->orderSummary) ? new OrderSummary() : $this->orderSummary;
    }

    /**
     * @param OrderSummary $orderSummary
     */
    public function setOrderSummary(OrderSummary $orderSummary)
    {
        $this->orderSummary = $orderSummary;
    }
}