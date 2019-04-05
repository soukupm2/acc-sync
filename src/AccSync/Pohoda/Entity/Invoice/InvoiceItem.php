<?php

namespace AccSync\Pohoda\Entity\Invoice;

/**
 * Class InvoiceItem
 *
 * @package AccSync\Pohoda\Entity\Invoice
 * @author  miroslav.soukup2@gmail.com
 */
class InvoiceItem
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $text
     */
    private $text;
    /**
     * @var float $quantity
     */
    private $quantity;
    /**
     * @var string $unit
     */
    private $unit;
    /**
     * @var float $coefficient
     */
    private $coefficient;
    /**
     * @var bool $payVAT
     */
    private $payVAT;
    /**
     * @var string $rateVAT
     */
    private $rateVAT;
    /**
     * @var float $discountPercentage
     */
    private $discountPercentage;
    /**
     * @var float $homeCurrencyUnitPrice
     */
    private $homeCurrencyUnitPrice;
    /**
     * @var float $homeCurrencyPrice
     */
    private $homeCurrencyPrice;
    /**
     * @var float $homeCurrencyPriceVAT
     */
    private $homeCurrencyPriceVAT;
    /**
     * @var float $homeCurrencyPriceSum
     */
    private $homeCurrencyPriceSum;
    /**
     * @var float $foreignCurrencyUnitPrice
     */
    private $foreignCurrencyUnitPrice;
    /**
     * @var float $foreignCurrencyPrice
     */
    private $foreignCurrencyPrice;
    /**
     * @var float $foreignCurrencyPriceVAT
     */
    private $foreignCurrencyPriceVAT;
    /**
     * @var float $foreignCurrencyPriceSum
     */
    private $foreignCurrencyPriceSum;
    /**
     * @var string $code
     */
    private $code;
    /**
     * @var int $guarantee
     */
    private $guarantee;
    /**
     * @var string $guaranteeType
     */
    private $guaranteeType;
    /**
     * @var int $storeId
     */
    private $storeId;
    /**
     * @var string $storeIds
     */
    private $storeIds;
    /**
     * @var int $stockItemId
     */
    private $stockItemId;
    /**
     * @var string $stockItemIds
     */
    private $stockItemIds;
    /**
     * @var string $stockItemPLU
     */
    private $stockItemPLU;
    /**
     * @var string $serialNumber
     */
    private $serialNumber;
    /**
     * @var bool $PDP
     */
    private $PDP;
    /**
     * @var bool $isAdvancePayment
     */
    private $isAdvancePayment;
    /**
     * @var string $sourceDocumentNumber
     */
    private $sourceDocumentNumber;

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
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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
     * @return float
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @param float $coefficient
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * @return bool
     */
    public function isPayVAT()
    {
        return $this->payVAT;
    }

    /**
     * @param bool $payVAT
     */
    public function setPayVAT($payVAT)
    {
        $this->payVAT = $payVAT;
    }

    /**
     * @return string
     */
    public function getRateVAT()
    {
        return $this->rateVAT;
    }

    /**
     * @param string $rateVAT
     */
    public function setRateVAT($rateVAT)
    {
        $this->rateVAT = $rateVAT;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * @param float $discountPercentage
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * @return float
     */
    public function getHomeCurrencyUnitPrice()
    {
        return $this->homeCurrencyUnitPrice;
    }

    /**
     * @param float $homeCurrencyUnitPrice
     */
    public function setHomeCurrencyUnitPrice($homeCurrencyUnitPrice)
    {
        $this->homeCurrencyUnitPrice = $homeCurrencyUnitPrice;
    }

    /**
     * @return float
     */
    public function getHomeCurrencyPrice()
    {
        return $this->homeCurrencyPrice;
    }

    /**
     * @param float $homeCurrencyPrice
     */
    public function setHomeCurrencyPrice($homeCurrencyPrice)
    {
        $this->homeCurrencyPrice = $homeCurrencyPrice;
    }

    /**
     * @return float
     */
    public function getHomeCurrencyPriceVAT()
    {
        return $this->homeCurrencyPriceVAT;
    }

    /**
     * @param float $homeCurrencyPriceVAT
     */
    public function setHomeCurrencyPriceVAT($homeCurrencyPriceVAT)
    {
        $this->homeCurrencyPriceVAT = $homeCurrencyPriceVAT;
    }

    /**
     * @return float
     */
    public function getHomeCurrencyPriceSum()
    {
        return $this->homeCurrencyPriceSum;
    }

    /**
     * @param float $homeCurrencyPriceSum
     */
    public function setHomeCurrencyPriceSum($homeCurrencyPriceSum)
    {
        $this->homeCurrencyPriceSum = $homeCurrencyPriceSum;
    }

    /**
     * @return float
     */
    public function getForeignCurrencyUnitPrice()
    {
        return $this->foreignCurrencyUnitPrice;
    }

    /**
     * @param float $foreignCurrencyUnitPrice
     */
    public function setForeignCurrencyUnitPrice($foreignCurrencyUnitPrice)
    {
        $this->foreignCurrencyUnitPrice = $foreignCurrencyUnitPrice;
    }

    /**
     * @return float
     */
    public function getForeignCurrencyPrice()
    {
        return $this->foreignCurrencyPrice;
    }

    /**
     * @param float $foreignCurrencyPrice
     */
    public function setForeignCurrencyPrice($foreignCurrencyPrice)
    {
        $this->foreignCurrencyPrice = $foreignCurrencyPrice;
    }

    /**
     * @return float
     */
    public function getForeignCurrencyPriceVAT()
    {
        return $this->foreignCurrencyPriceVAT;
    }

    /**
     * @param float $foreignCurrencyPriceVAT
     */
    public function setForeignCurrencyPriceVAT($foreignCurrencyPriceVAT)
    {
        $this->foreignCurrencyPriceVAT = $foreignCurrencyPriceVAT;
    }

    /**
     * @return float
     */
    public function getForeignCurrencyPriceSum()
    {
        return $this->foreignCurrencyPriceSum;
    }

    /**
     * @param float $foreignCurrencyPriceSum
     */
    public function setForeignCurrencyPriceSum($foreignCurrencyPriceSum)
    {
        $this->foreignCurrencyPriceSum = $foreignCurrencyPriceSum;
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
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * @return string
     */
    public function getStoreIds()
    {
        return $this->storeIds;
    }

    /**
     * @param string $storeIds
     */
    public function setStoreIds($storeIds)
    {
        $this->storeIds = $storeIds;
    }

    /**
     * @return int
     */
    public function getStockItemId()
    {
        return $this->stockItemId;
    }

    /**
     * @param int $stockItemId
     */
    public function setStockItemId($stockItemId)
    {
        $this->stockItemId = $stockItemId;
    }

    /**
     * @return string
     */
    public function getStockItemIds()
    {
        return $this->stockItemIds;
    }

    /**
     * @param string $stockItemIds
     */
    public function setStockItemIds($stockItemIds)
    {
        $this->stockItemIds = $stockItemIds;
    }

    /**
     * @return string
     */
    public function getStockItemPLU()
    {
        return $this->stockItemPLU;
    }

    /**
     * @param string $stockItemPLU
     */
    public function setStockItemPLU($stockItemPLU)
    {
        $this->stockItemPLU = $stockItemPLU;
    }

    /**
     * @return bool
     */
    public function isPDP()
    {
        return $this->PDP;
    }

    /**
     * @param bool $PDP
     */
    public function setPDP($PDP)
    {
        $this->PDP = $PDP;
    }

    /**
     * @return bool
     */
    public function isAdvancePayment()
    {
        return $this->isAdvancePayment;
    }

    /**
     * @param bool $isAdvancePayment
     */
    public function setIsAdvancePayment($isAdvancePayment)
    {
        $this->isAdvancePayment = $isAdvancePayment;
    }

    /**
     * @return int
     */
    public function getGuarantee()
    {
        return $this->guarantee;
    }

    /**
     * @param int $guarantee
     */
    public function setGuarantee($guarantee)
    {
        $this->guarantee = $guarantee;
    }

    /**
     * @return string
     */
    public function getSourceDocumentNumber()
    {
        return $this->sourceDocumentNumber;
    }

    /**
     * @param string $sourceDocumentNumber
     */
    public function setSourceDocumentNumber($sourceDocumentNumber)
    {
        $this->sourceDocumentNumber = $sourceDocumentNumber;
    }

    /**
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }
}