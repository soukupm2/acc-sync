<?php

namespace AccSync\Pohoda\Entity\Order;

use AccSync\Pohoda\Entity\Address;

class OrderHeader
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $orderType
     */
    private $orderType;
    /**
     * @var int $numberId
     */
    private $numberId;
    /**
     * @var int $numberIds
     */
    private $numberIds;
    /**
     * @var int $numberRequested
     */
    private $numberRequested;
    /**
     * @var string $date
     */
    private $date;
    /**
     * @var string $dateFrom
     */
    private $dateFrom;
    /**
     * @var string $dateTo
     */
    private $dateTo;
    /**
     * @var string $text
     */
    private $text;
    /**
     * @var int $partnerIdentityId
     */
    private $partnerIdentityId;
    /**
     * @var Address $partnerIdentityAddress
     */
    private $partnerIdentityAddress;
    /**
     * @var Address $myIdentityAddress
     */
    private $myIdentityAddress;
    /**
     * @var int $paymentTypeId
     */
    private $paymentTypeId;
    /**
     * @var string $paymentTypeIds
     */
    private $paymentTypeIds;
    /**
     * @var string $paymentType
     */
    private $paymentType;
    /**
     * @var bool $isExecuted
     */
    private $isExecuted;
    /**
     * @var bool $isDelivered
     */
    private $isDelivered;
    /**
     * @var bool $isReserved
     */
    private $isReserved;
    /**
     * @var bool $isPermanentDocument
     */
    private $isPermanentDocument;
    /**
     * @var bool $markRecord
     */
    private $markRecord;

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
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
    }

    /**
     * @return int
     */
    public function getNumberId()
    {
        return $this->numberId;
    }

    /**
     * @param int $numberId
     */
    public function setNumberId($numberId)
    {
        $this->numberId = $numberId;
    }

    /**
     * @return int
     */
    public function getNumberIds()
    {
        return $this->numberIds;
    }

    /**
     * @param int $numberIds
     */
    public function setNumberIds($numberIds)
    {
        $this->numberIds = $numberIds;
    }

    /**
     * @return int
     */
    public function getNumberRequested()
    {
        return $this->numberRequested;
    }

    /**
     * @param int $numberRequested
     */
    public function setNumberRequested($numberRequested)
    {
        $this->numberRequested = $numberRequested;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @param string $dateFrom
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return string
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param string $dateTo
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getPaymentTypeId()
    {
        return $this->paymentTypeId;
    }

    /**
     * @param int $paymentTypeId
     */
    public function setPaymentTypeId($paymentTypeId)
    {
        $this->paymentTypeId = $paymentTypeId;
    }

    /**
     * @return string
     */
    public function getPaymentTypeIds()
    {
        return $this->paymentTypeIds;
    }

    /**
     * @param string $paymentTypeIds
     */
    public function setPaymentTypeIds($paymentTypeIds)
    {
        $this->paymentTypeIds = $paymentTypeIds;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return bool
     */
    public function isExecuted()
    {
        return $this->isExecuted;
    }

    /**
     * @param bool $isExecuted
     */
    public function setIsExecuted($isExecuted)
    {
        $this->isExecuted = $isExecuted;
    }

    /**
     * @return bool
     */
    public function isDelivered()
    {
        return $this->isDelivered;
    }

    /**
     * @param bool $isDelivered
     */
    public function setIsDelivered($isDelivered)
    {
        $this->isDelivered = $isDelivered;
    }

    /**
     * @return bool
     */
    public function isReserved()
    {
        return $this->isReserved;
    }

    /**
     * @param bool $isReserved
     */
    public function setIsReserved($isReserved)
    {
        $this->isReserved = $isReserved;
    }

    /**
     * @return int
     */
    public function getPartnerIdentityId()
    {
        return $this->partnerIdentityId;
    }

    /**
     * @param int $partnerIdentityId
     */
    public function setPartnerIdentityId($partnerIdentityId)
    {
        $this->partnerIdentityId = $partnerIdentityId;
    }

    /**
     * @return Address
     */
    public function getPartnerIdentityAddress()
    {
        return $this->partnerIdentityAddress;
    }

    /**
     * @param Address $partnerIdentityAddress
     */
    public function setPartnerIdentityAddress($partnerIdentityAddress)
    {
        $this->partnerIdentityAddress = $partnerIdentityAddress;
    }

    /**
     * @return Address
     */
    public function getMyIdentityAddress()
    {
        return $this->myIdentityAddress;
    }

    /**
     * @param Address $myIdentityAddress
     */
    public function setMyIdentityAddress(Address $myIdentityAddress)
    {
        $this->myIdentityAddress = $myIdentityAddress;
    }

    /**
     * @return bool
     */
    public function isPermanentDocument()
    {
        return $this->isPermanentDocument;
    }

    /**
     * @param bool $isPermanentDocument
     */
    public function setIsPermanentDocument($isPermanentDocument)
    {
        $this->isPermanentDocument = $isPermanentDocument;
    }

    /**
     * @return bool
     */
    public function isMarkRecord()
    {
        return $this->markRecord;
    }

    /**
     * @param bool $markRecord
     */
    public function setMarkRecord($markRecord)
    {
        $this->markRecord = $markRecord;
    }
}