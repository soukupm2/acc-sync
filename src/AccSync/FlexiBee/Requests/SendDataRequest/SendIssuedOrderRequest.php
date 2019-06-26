<?php

namespace AccSync\FlexiBee\Requests\SendDataRequest;

class SendIssuedOrderRequest extends BaseSendDataRequest
{
    const REGISTER = 'objednavka-vydana';

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
     * @var string $dateOfIssue
     */
    private $dateOfIssue;
    /**
     * @var float $totalAmount
     */
    private $totalAmount;
    /**
     * @var float $totalAmountInCurrency
     */
    private $totalAmountInCurrency;
    /**
     * @var string $currency
     */
    private $currency;
    /**
     * @var string $company
     */
    private $company;
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var string $type
     */
    private $type;
    /**
     * @var array $aliases
     */
    protected $aliases = [
        'code' => 'kod',
        'paidToDate' => 'stavUhrK',
        'dateOfIssue' => 'datVyst',
        'totalAmount' => 'sumCelkem',
        'totalAmountInCurrency' => 'zbyvaUhraditMen',
        'currency' => 'mena',
        'company' => 'firma',
        'description' => 'popis',
        'type' => 'typDokl',
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
     * @param string $dateOfIssue
     */
    public function setDateOfIssue($dateOfIssue)
    {
        $this->dateOfIssue = $dateOfIssue;

        return $this;
    }

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @param float $totalAmountInCurrency
     */
    public function setTotalAmountInCurrency($totalAmountInCurrency)
    {
        $this->totalAmountInCurrency = $totalAmountInCurrency;

        return $this;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;

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