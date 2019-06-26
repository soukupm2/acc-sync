<?php

namespace AccSync\FlexiBee\Requests\SendDataRequest;

class SendPriceItemRequest extends BaseSendDataRequest
{
    const REGISTER = 'cenik';

    protected $register = self::REGISTER;

    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $code
     */
    private $code;
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var float $basePrice
     */
    private $basePrice;
    /**
     * @var float $basePriceWitohoutVat
     */
    private $basePriceWitohoutVat;
    /**
     * @var float $basePriceWithVat
     */
    private $basePriceWithVat;
    /**
     * @var float $vatRate
     */
    private $vatRate;
    /**
     * @var array $aliases
     */
    protected $aliases = [
        'code' => 'kod',
        'name' => 'nazev',
        'basePrice' => 'cenaZakl',
        'basePriceWitohoutVat' => 'cenaZaklBezDph',
        'basePriceWithVat' => 'cenaZaklVcDph',
        'vatRate' => 'szbDph',
    ];

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param float $basePrice
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    /**
     * @param float $basePriceWitohoutVat
     */
    public function setBasePriceWitohoutVat($basePriceWitohoutVat)
    {
        $this->basePriceWitohoutVat = $basePriceWitohoutVat;

        return $this;
    }

    /**
     * @param float $basePriceWithVat
     */
    public function setBasePriceWithVat($basePriceWithVat)
    {
        $this->basePriceWithVat = $basePriceWithVat;

        return $this;
    }

    /**
     * @param float $vatRate
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function mapOptions()
    {
        foreach ($this as $key => $value)
        {
            $property = $key;

            if (isset($this->aliases[$key]))
            {
                $property = $this->aliases[$key];
            }

            if (!in_array($key, $this->ignoredProperties) && !empty($value))
            {
                $this->rawData[$this->rootKey][$this->getRegister()][$property] = $value;
            }
        }

        if (!empty($this->additionalData) && is_array($this->additionalData))
        {
            foreach ($this->additionalData[$this->rootKey][$this->getRegister()] as $key => $value)
            {
                $this->rawData[$this->rootKey][$this->getRegister()][$key] = $value;
            }
        }
    }
}