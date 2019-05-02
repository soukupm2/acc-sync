<?php

namespace AccSync\FlexiBee\Requests\SendDataRequest;

class SendIssuedInvoiceRequest extends BaseSendDataRequest
{
    const REGISTER = 'faktura-prijata';

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
     * @var string $paidToDate
     */
    private $paidToDate;
    /**
     * @var string $dateOfIssue
     */
    private $dateOfIssue;
    /**
     * @var string $dueDate
     */
    private $dueDate;
    /**
     * @var float $totalAmount
     */
    private $totalAmount;
    /**
     * @var float $depositAmount
     */
    private $depositAmount;
    /**
     * @var float $depositAmountInCurrency
     */
    private $depositAmountInCurrency;
    /**
     * @var float $totalAmountInCurrency
     */
    private $totalAmountInCurrency;
    /**
     * @var float $leftToPay
     */
    private $leftToPay;
    /**
     * @var float $leftToPayInCurrency
     */
    private $leftToPayInCurrency;
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
     * @var array $aliases
     */
    protected $aliases = [
        'code' => 'kod',
        'paidToDate' => 'stavUhrK',
        'dateOfIssue' => 'datVyst',
        'dueDate' => 'datSplat',
        'totalAmount' => 'sumCelkem',
        'depositAmount' => 'sumZalohy',
        'depositAmountInCurrency' => 'sumZalohyMen',
        'totalAmountInCurrency' => 'zbyvaUhraditMen',
        'leftToPay' => 'zbyvaUhradit',
        'currency' => 'mena',
        'company' => 'firma',
        'description' => 'popis',
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
     * @param string $paidToDate
     */
    public function setPaidToDate($paidToDate)
    {
        $this->paidToDate = $paidToDate;

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
     * @param string $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

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
     * @param float $depositAmount
     */
    public function setDepositAmount($depositAmount)
    {
        $this->depositAmount = $depositAmount;

        return $this;
    }

    /**
     * @param float $depositAmountInCurrency
     */
    public function setDepositAmountInCurrency($depositAmountInCurrency)
    {
        $this->depositAmountInCurrency = $depositAmountInCurrency;

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
     * @param float $leftToPay
     */
    public function setLeftToPay($leftToPay)
    {
        $this->leftToPay = $leftToPay;

        return $this;
    }

    /**
     * @param float $leftToPayInCurrency
     */
    public function setLeftToPayInCurrency($leftToPayInCurrency)
    {
        $this->leftToPayInCurrency = $leftToPayInCurrency;

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
            $this->rawData = array_merge($this->rawData, $this->additionalData);
        }
    }
}