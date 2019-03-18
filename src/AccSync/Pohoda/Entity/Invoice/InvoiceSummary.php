<?php

namespace AccSync\Pohoda\Entity\Invoice;

class InvoiceSummary
{
    /**
     * @var string $roundingDocument How the price was rounded (up2one, math2one)
     */
    private $roundingDocument;
    /**
     * @var string $roundingVat How the Vat was rounded
     */
    private $roundingVat;
    /**
     * @var bool $calculateVat If the Vat is supposed to be calculated
     */
    private $calculateVat;
    /**
     * @var float $priceNone
     */
    private $priceNone;
    /**
     * @var float $priceLow
     */
    private $priceLow;
    /**
     * @var float $priceLowVAT
     */
    private $priceLowVAT;
    /**
     * @var float $priceLowSum
     */
    private $priceLowSum;
    /**
     * @var float $priceHigh
     */
    private $priceHigh;
    /**
     * @var float $priceHighVAT
     */
    private $priceHighVAT;
    /**
     * @var float $priceHighSum
     */
    private $priceHighSum;
    /**
     * @var float $price3
     */
    private $price3;
    /**
     * @var float $price3VAT
     */
    private $price3VAT;
    /**
     * @var float $price3Sum
     */
    private $price3Sum;
    /**
     * @var float $priceRound
     */
    private $priceRound;
    /**
     * @var int $foreignCurrencyId
     */
    private $foreignCurrencyId;
    /**
     * @var string $foreignCurrencyIds
     */
    private $foreignCurrencyIds;
    /**
     * @var float $foreignCurrencyRate
     */
    private $foreignCurrencyRate;
    /**
     * @var float $foreignCurrencyAmount
     */
    private $foreignCurrencyAmount;
    /**
     * @var float $foreignCurrencyPriceSum
     */
    private $foreignCurrencyPriceSum;

    /**
     * @return string
     */
    public function getRoundingDocument()
    {
        return $this->roundingDocument;
    }

    /**
     * @param string $roundingDocument
     */
    public function setRoundingDocument($roundingDocument)
    {
        $this->roundingDocument = $roundingDocument;
    }

    /**
     * @return string
     */
    public function getRoundingVat()
    {
        return $this->roundingVat;
    }

    /**
     * @param string $roundingVat
     */
    public function setRoundingVat($roundingVat)
    {
        $this->roundingVat = $roundingVat;
    }

    /**
     * @return bool
     */
    public function getCalculateVat()
    {
        return $this->calculateVat;
    }

    /**
     * @param bool $calculateVat
     */
    public function setCalculateVat($calculateVat)
    {
        $this->calculateVat = $calculateVat;
    }

    /**
     * @return float
     */
    public function getPriceNone()
    {
        return $this->priceNone;
    }

    /**
     * @param float $priceNone
     */
    public function setPriceNone($priceNone)
    {
        $this->priceNone = $priceNone;
    }

    /**
     * @return float
     */
    public function getPriceLow()
    {
        return $this->priceLow;
    }

    /**
     * @param float $priceLow
     */
    public function setPriceLow($priceLow)
    {
        $this->priceLow = $priceLow;
    }

    /**
     * @return float
     */
    public function getPriceLowVAT()
    {
        return $this->priceLowVAT;
    }

    /**
     * @param float $priceLowVAT
     */
    public function setPriceLowVAT($priceLowVAT)
    {
        $this->priceLowVAT = $priceLowVAT;
    }

    /**
     * @return float
     */
    public function getPriceLowSum()
    {
        return $this->priceLowSum;
    }

    /**
     * @param float $priceLowSum
     */
    public function setPriceLowSum($priceLowSum)
    {
        $this->priceLowSum = $priceLowSum;
    }

    /**
     * @return float
     */
    public function getPriceHigh()
    {
        return $this->priceHigh;
    }

    /**
     * @param float $priceHigh
     */
    public function setPriceHigh($priceHigh)
    {
        $this->priceHigh = $priceHigh;
    }

    /**
     * @return float
     */
    public function getPriceHighVAT()
    {
        return $this->priceHighVAT;
    }

    /**
     * @param float $priceHighVAT
     */
    public function setPriceHighVAT($priceHighVAT)
    {
        $this->priceHighVAT = $priceHighVAT;
    }

    /**
     * @return float
     */
    public function getPriceHighSum()
    {
        return $this->priceHighSum;
    }

    /**
     * @param float $priceHighSum
     */
    public function setPriceHighSum($priceHighSum)
    {
        $this->priceHighSum = $priceHighSum;
    }

    /**
     * @return float
     */
    public function getPrice3()
    {
        return $this->price3;
    }

    /**
     * @param float $price3
     */
    public function setPrice3($price3)
    {
        $this->price3 = $price3;
    }

    /**
     * @return float
     */
    public function getPrice3VAT()
    {
        return $this->price3VAT;
    }

    /**
     * @param float $price3VAT
     */
    public function setPrice3VAT($price3VAT)
    {
        $this->price3VAT = $price3VAT;
    }

    /**
     * @return float
     */
    public function getPrice3Sum()
    {
        return $this->price3Sum;
    }

    /**
     * @param float $price3Sum
     */
    public function setPrice3Sum($price3Sum)
    {
        $this->price3Sum = $price3Sum;
    }

    /**
     * @return float
     */
    public function getPriceRound()
    {
        return $this->priceRound;
    }

    /**
     * @param float $priceRound
     */
    public function setPriceRound($priceRound)
    {
        $this->priceRound = $priceRound;
    }

    /**
     * @return string
     */
    public function getForeignCurrencyIds()
    {
        return $this->foreignCurrencyIds;
    }

    /**
     * @param string $foreignCurrencyIds
     */
    public function setForeignCurrencyIds($foreignCurrencyIds)
    {
        $this->foreignCurrencyIds = $foreignCurrencyIds;
    }

    /**
     * @return float
     */
    public function getForeignCurrencyRate()
    {
        return $this->foreignCurrencyRate;
    }

    /**
     * @param float $foreignCurrencyRate
     */
    public function setForeignCurrencyRate($foreignCurrencyRate)
    {
        $this->foreignCurrencyRate = $foreignCurrencyRate;
    }

    /**
     * @return float
     */
    public function getForeignCurrencyAmount()
    {
        return $this->foreignCurrencyAmount;
    }

    /**
     * @param float $foreignCurrencyAmount
     */
    public function setForeignCurrencyAmount($foreignCurrencyAmount)
    {
        $this->foreignCurrencyAmount = $foreignCurrencyAmount;
    }

    /**
     * @return int
     */
    public function getForeignCurrencyId()
    {
        return $this->foreignCurrencyId;
    }

    /**
     * @param int $foreignCurrencyId
     */
    public function setForeignCurrencyId($foreignCurrencyId)
    {
        $this->foreignCurrencyId = $foreignCurrencyId;
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
}