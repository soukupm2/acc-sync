<?php

namespace AccSync\Pohoda\Entity\Invoice;

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
     * @var bool $PDP
     */
    private $PDP;
    /**
     * @var bool $isAdvancePayment
     */
    private $isAdvancePayment;

    /**
     * InvoiceItem constructor.
     *
     * @param int    $id
     * @param string $text
     * @param float  $quantity
     * @param string $unit
     * @param float  $coefficient
     * @param bool   $payVAT
     * @param string $rateVAT
     * @param float  $discountPercentage
     * @param float  $homeCurrencyUnitPrice
     * @param float  $homeCurrencyPrice
     * @param float  $homeCurrencyPriceVAT
     * @param float  $homeCurrencyPriceSum
     * @param float  $foreignCurrencyUnitPrice
     * @param float  $foreignCurrencyPrice
     * @param float  $foreignCurrencyPriceVAT
     * @param float  $foreignCurrencyPriceSum
     * @param string $code
     * @param int    $guarantee
     * @param string $guaranteeType
     * @param int    $storeId
     * @param string $storeIds
     * @param int    $stockItemId
     * @param string $stockItemIds
     * @param string $stockItemPLU
     * @param bool   $PDP
     * @param bool   $isAdvancePayment
     */
    public function __construct(
        $id = NULL,
        $text = '',
        $quantity = 0.0,
        $unit = '',
        $coefficient = 0.0,
        $payVAT = FALSE,
        $rateVAT = '',
        $discountPercentage = 0.0,
        $homeCurrencyUnitPrice = 0.0,
        $homeCurrencyPrice = 0.0,
        $homeCurrencyPriceVAT = 0.0,
        $homeCurrencyPriceSum = 0.0,
        $foreignCurrencyUnitPrice = 0.0,
        $foreignCurrencyPrice = 0.0,
        $foreignCurrencyPriceVAT = 0.0,
        $foreignCurrencyPriceSum = 0.0,
        $code = '',
        $guarantee = 0,
        $guaranteeType = '',
        $storeId = 0,
        $storeIds = '',
        $stockItemId = 0,
        $stockItemIds = '',
        $stockItemPLU = '',
        $PDP = FALSE,
        $isAdvancePayment = FALSE
    )
    {
        $this->id = $id;
        $this->text = $text;
        $this->quantity = $quantity;
        $this->unit = $unit;
        $this->coefficient = $coefficient;
        $this->payVAT = $payVAT;
        $this->rateVAT = $rateVAT;
        $this->discountPercentage = $discountPercentage;
        $this->homeCurrencyUnitPrice = $homeCurrencyUnitPrice;
        $this->homeCurrencyPrice = $homeCurrencyPrice;
        $this->homeCurrencyPriceVAT = $homeCurrencyPriceVAT;
        $this->homeCurrencyPriceSum = $homeCurrencyPriceSum;
        $this->foreignCurrencyUnitPrice = $foreignCurrencyUnitPrice;
        $this->foreignCurrencyPrice = $foreignCurrencyPrice;
        $this->foreignCurrencyPriceVAT = $foreignCurrencyPriceVAT;
        $this->foreignCurrencyPriceSum = $foreignCurrencyPriceSum;
        $this->code = $code;
        $this->guaranteeType = $guaranteeType;
        $this->storeId = $storeId;
        $this->storeIds = $storeIds;
        $this->stockItemId = $stockItemId;
        $this->stockItemIds = $stockItemIds;
        $this->stockItemPLU = $stockItemPLU;
        $this->PDP = $PDP;
        $this->isAdvancePayment = $isAdvancePayment;
        $this->guarantee = $guarantee;
    }

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
}