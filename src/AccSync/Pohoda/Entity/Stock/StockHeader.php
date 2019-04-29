<?php

namespace AccSync\Pohoda\Entity\Stock;

/**
 * Class StockHeader
 *
 * @package AccSync\Pohoda\Entity\Stock
 * @author  miroslav.soukup2@gmail.com
 */
class StockHeader
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $stockType
     */
    private $stockType;
    /**
     * @var string $code
     */
    private $code;
    /**
     * @var string $ean
     */
    private $ean;
    /**
     * @var int $PLU
     */
    private $PLU;
    /**
     * @var bool $isSales
     */
    private $isSales;
    /**
     * @var bool $isSerialNumber
     */
    private $isSerialNumber;
    /**
     * @var bool $isInternet
     */
    private $isInternet;
    /**
     * @var bool $isBatch
     */
    private $isBatch;
    /**
     * @var string $purchasingRateVAT
     */
    private $purchasingRateVAT;
    /**
     * @var string $sellingRateVAT
     */
    private $sellingRateVAT;
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var string $nameComplement
     */
    private $nameComplement;
    /**
     * @var string $unit
     */
    private $unit;
    /**
     * @var int $storageId
     */
    private $storageId;
    /**
     * @var string $storageIds
     */
    private $storageIds;
    /**
     * @var int $typePriceId
     */
    private $typePriceId;
    /**
     * @var string $typePriceIds
     */
    private $typePriceIds;
    /**
     * @var float $weightedPurchasePrice
     */
    private $weightedPurchasePrice;
    /**
     * @var float $purchasingPrice
     */
    private $purchasingPrice;
    /**
     * @var float $sellingPrice
     */
    private $sellingPrice;
    /**
     * @var float $limitMin
     */
    private $limitMin;
    /**
     * @var float $limitMax
     */
    private $limitMax;
    /**
     * @var float $mass
     */
    private $mass;
    /**
     * @var string $shortName
     */
    private $shortName;
    /**
     * @var float $count
     */
    private $count;
    /**
     * @var float $countReceivedOrders
     */
    private $countReceivedOrders;
    /**
     * @var float $reservation
     */
    private $reservation;
    /**
     * @var float $reclamation
     */
    private $reclamation;
    /**
     * @var int $supplierId;
     */
    private $supplierId;
    /**
     * @var float $orderQuantity
     */
    private $orderQuantity;
    /**
     * @var float $countIssuedOrders
     */
    private $countIssuedOrders;
    /**
     * @var string $guaranteeType
     */
    private $guaranteeType;
    /**
     * @var float $guarantee
     */
    private $guarantee;
    /**
     * @var string $producer
     */
    private $producer;
    /**
     * @var bool $news
     */
    private $news;
    /**
     * @var bool $clearanceSale
     */
    private $clearanceSale;
    /**
     * @var bool $sale
     */
    private $sale;
    /**
     * @var bool $recommended
     */
    private $recommended;
    /**
     * @var bool $discount
     */
    private $discount;
    /**
     * @var bool $prepare
     */
    private $prepare;
    /**
     * @var bool $controlLimitTaxLiability
     */
    private $controlLimitTaxLiability;
    /**
     * @var string $descrtiption
     */
    private $description;
    /**
     * @var string $description2
     */
    private $description2;
    /**
     * @var bool $markRecord
     */
    private $markRecord;
    /**
     * @var string $note
     */
    private $note;
    /**
     * @var $yield
     */
    private $yield;

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
    public function getStockType()
    {
        return $this->stockType;
    }

    /**
     * @param string $stockType
     */
    public function setStockType($stockType)
    {
        $this->stockType = $stockType;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getPLU()
    {
        return $this->PLU;
    }

    /**
     * @param int $PLU
     */
    public function setPLU($PLU)
    {
        $this->PLU = $PLU;
    }

    /**
     * @return bool
     */
    public function isSales()
    {
        return $this->isSales;
    }

    /**
     * @param bool $isSales
     */
    public function setIsSales($isSales)
    {
        $this->isSales = $isSales;
    }

    /**
     * @return bool
     */
    public function isSerialNumber()
    {
        return $this->isSerialNumber;
    }

    /**
     * @param bool $isSerialNumber
     */
    public function setIsSerialNumber($isSerialNumber)
    {
        $this->isSerialNumber = $isSerialNumber;
    }

    /**
     * @return bool
     */
    public function isInternet()
    {
        return $this->isInternet;
    }

    /**
     * @param bool $isInternet
     */
    public function setIsInternet($isInternet)
    {
        $this->isInternet = $isInternet;
    }

    /**
     * @return bool
     */
    public function isBatch()
    {
        return $this->isBatch;
    }

    /**
     * @param bool $isBatch
     */
    public function setIsBatch($isBatch)
    {
        $this->isBatch = $isBatch;
    }

    /**
     * @return string
     */
    public function getPurchasingRateVAT()
    {
        return $this->purchasingRateVAT;
    }

    /**
     * @param string $purchasingRateVAT
     */
    public function setPurchasingRateVAT($purchasingRateVAT)
    {
        $this->purchasingRateVAT = $purchasingRateVAT;
    }

    /**
     * @return string
     */
    public function getSellingRateVAT()
    {
        return $this->sellingRateVAT;
    }

    /**
     * @param string $sellingRateVAT
     */
    public function setSellingRateVAT($sellingRateVAT)
    {
        $this->sellingRateVAT = $sellingRateVAT;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNameComplement()
    {
        return $this->nameComplement;
    }

    /**
     * @param string $nameComplement
     */
    public function setNameComplement($nameComplement)
    {
        $this->nameComplement = $nameComplement;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return int
     */
    public function getStorageId()
    {
        return $this->storageId;
    }

    /**
     * @param int $storageId
     */
    public function setStorageId($storageId)
    {
        $this->storageId = $storageId;
    }

    /**
     * @return string
     */
    public function getStorageIds()
    {
        return $this->storageIds;
    }

    /**
     * @param string $storageIds
     */
    public function setStorageIds($storageIds)
    {
        $this->storageIds = $storageIds;
    }

    /**
     * @return int
     */
    public function getTypePriceId()
    {
        return $this->typePriceId;
    }

    /**
     * @param int $typePriceId
     */
    public function setTypePriceId($typePriceId)
    {
        $this->typePriceId = $typePriceId;
    }

    /**
     * @return string
     */
    public function getTypePriceIds()
    {
        return $this->typePriceIds;
    }

    /**
     * @param string $typePriceIds
     */
    public function setTypePriceIds($typePriceIds)
    {
        $this->typePriceIds = $typePriceIds;
    }

    /**
     * @return float
     */
    public function getWeightedPurchasePrice()
    {
        return $this->weightedPurchasePrice;
    }

    /**
     * @param float $weightedPurchasePrice
     */
    public function setWeightedPurchasePrice($weightedPurchasePrice)
    {
        $this->weightedPurchasePrice = $weightedPurchasePrice;
    }

    /**
     * @return float
     */
    public function getPurchasingPrice()
    {
        return $this->purchasingPrice;
    }

    /**
     * @param float $purchasingPrice
     */
    public function setPurchasingPrice($purchasingPrice)
    {
        $this->purchasingPrice = $purchasingPrice;
    }

    /**
     * @return float
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * @param float $sellingPrice
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
    }

    /**
     * @return float
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param float $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return float
     */
    public function getCountReceivedOrders()
    {
        return $this->countReceivedOrders;
    }

    /**
     * @param float $countReceivedOrders
     */
    public function setCountReceivedOrders($countReceivedOrders)
    {
        $this->countReceivedOrders = $countReceivedOrders;
    }

    /**
     * @return float
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * @param float $reservation
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * @return float
     */
    public function getReclamation()
    {
        return $this->reclamation;
    }

    /**
     * @param float $reclamation
     */
    public function setReclamation($reclamation)
    {
        $this->reclamation = $reclamation;
    }

    /**
     * @return int
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * @param int $supplierId
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return float
     */
    public function getOrderQuantity()
    {
        return $this->orderQuantity;
    }

    /**
     * @param float $orderQuantity
     */
    public function setOrderQuantity($orderQuantity)
    {
        $this->orderQuantity = $orderQuantity;
    }

    /**
     * @return float
     */
    public function getCountIssuedOrders()
    {
        return $this->countIssuedOrders;
    }

    /**
     * @param float $countIssuedOrders
     */
    public function setCountIssuedOrders($countIssuedOrders)
    {
        $this->countIssuedOrders = $countIssuedOrders;
    }

    /**
     * @return string
     */
    public function getGuaranteeType()
    {
        return $this->guaranteeType;
    }

    /**
     * @param string $guaranteeType
     */
    public function setGuaranteeType($guaranteeType)
    {
        $this->guaranteeType = $guaranteeType;
    }

    /**
     * @return float
     */
    public function getGuarantee()
    {
        return $this->guarantee;
    }

    /**
     * @param float $guarantee
     */
    public function setGuarantee($guarantee)
    {
        $this->guarantee = $guarantee;
    }

    /**
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param string $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }

    /**
     * @return bool
     */
    public function isNews()
    {
        return $this->news;
    }

    /**
     * @param bool $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

    /**
     * @return bool
     */
    public function isClearanceSale()
    {
        return $this->clearanceSale;
    }

    /**
     * @param bool $clearanceSale
     */
    public function setClearanceSale($clearanceSale)
    {
        $this->clearanceSale = $clearanceSale;
    }

    /**
     * @return bool
     */
    public function isSale()
    {
        return $this->sale;
    }

    /**
     * @param bool $sale
     */
    public function setSale($sale)
    {
        $this->sale = $sale;
    }

    /**
     * @return bool
     */
    public function isRecommended()
    {
        return $this->recommended;
    }

    /**
     * @param bool $recommended
     */
    public function setRecommended($recommended)
    {
        $this->recommended = $recommended;
    }

    /**
     * @return bool
     */
    public function isDiscount()
    {
        return $this->discount;
    }

    /**
     * @param bool $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return bool
     */
    public function isPrepare()
    {
        return $this->prepare;
    }

    /**
     * @param bool $prepare
     */
    public function setPrepare($prepare)
    {
        $this->prepare = $prepare;
    }

    /**
     * @return bool
     */
    public function isControlLimitTaxLiability()
    {
        return $this->controlLimitTaxLiability;
    }

    /**
     * @param bool $controlLimitTaxLiability
     */
    public function setControlLimitTaxLiability($controlLimitTaxLiability)
    {
        $this->controlLimitTaxLiability = $controlLimitTaxLiability;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * @param string $description2
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;
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

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return float
     */
    public function getLimitMin()
    {
        return $this->limitMin;
    }

    /**
     * @param float $limitMin
     */
    public function setLimitMin($limitMin)
    {
        $this->limitMin = $limitMin;
    }

    /**
     * @return float
     */
    public function getLimitMax()
    {
        return $this->limitMax;
    }

    /**
     * @param float $limitMax
     */
    public function setLimitMax($limitMax)
    {
        $this->limitMax = $limitMax;
    }

    /**
     * @return float
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @param float $mass
     */
    public function setMass($mass)
    {
        $this->mass = $mass;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getYield()
    {
        return $this->yield;
    }

    /**
     * @param mixed $yield
     */
    public function setYield($yield)
    {
        $this->yield = $yield;
    }
}