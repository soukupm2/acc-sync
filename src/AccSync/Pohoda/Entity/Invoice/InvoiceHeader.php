<?php

namespace AccSync\Pohoda\Entity\Invoice;

use AccSync\Pohoda\Data\PohodaHelper;
use AccSync\Pohoda\Entity\Address;

class InvoiceHeader
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $invoiceType Type of invoice
     */
    private $invoiceType;
    /**
     * @var int $numberRequested
     */
    private $numberRequested;
    /**
     * @var int $symVar
     */
    private $symVar;
    /**
     * @var string $date
     */
    private $date;
    /**
     * @var string $dateTax
     */
    private $dateTax;
    /**
     * @var string $dateAccounting
     */
    private $dateAccounting;
    /**
     * @var string $dateDue
     */
    private $dateDue;
    /**
     * @var int $accountingId
     */
    private $accountingId;
    /**
     * @var string $accountingIds
     */
    private $accountingIds;
    /**
     * @var int $classificationVatId
     */
    private $classificationVatId;
    /**
     * @var string $classificationVatIds
     */
    private $classificationVatIds;
    /**
     * @var string $classificationVatType
     */
    private $classificationVatType;
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
     * @var int $accountId
     */
    private $accountId;
    /**
     * @var string $accountIds
     */
    private $accountIds;
    /**
     * @var string $accountBankCode
     */
    private $accountBankCode;
    /**
     * @var string $accountNo
     */
    private $accountNo;
    /**
     * @var string $symConst
     */
    private $symConst;
    /**
     * @var float $liquidationAmountHome
     */
    private $liquidationAmountHome;
    /**
     * @var bool $markRecord
     */
    private $markRecord;
    /**
     * @var string $note
     */
    private $note;
    /**
     * @var string $intNote
     */
    private $intNote;
    /**
     * @var string $centreIds
     */
    private $centreIds;
    /**
     * @var string $activityIds
     */
    private $activityIds;

    /**
     * InvoiceHeader constructor.
     *
     * @param int       $id
     * @param string    $invoiceType
     * @param int       $numberRequested
     * @param int       $symVar
     * @param \DateTime $date
     * @param \DateTime $dateTax
     * @param \DateTime $dateAccounting
     * @param \DateTime $dateDue
     * @param int       $accountingId
     * @param string    $accountingIds
     * @param int       $classificationVatId
     * @param string    $classificationVatIds
     * @param string    $classificationVatType
     * @param string    $text
     * @param int       $partnerIdentityId
     * @param Address   $partnerIdentityAddress
     * @param Address   $myIdentityAddress
     * @param int       $paymentTypeId
     * @param string    $paymentTypeIds
     * @param string    $paymentType
     * @param int       $accountId
     * @param string    $accountBankCode
     * @param string    $accountIds
     * @param string    $accountNo
     * @param string    $symConst
     * @param float     $liquidationAmountHome
     * @param bool      $markRecord
     * @param string    $note
     * @param string    $intNote
     * @param string    $centreIds
     * @param string    $activityIds
     */
    public function __construct(
        $id= 0,
        $invoiceType = '',
        $numberRequested = 0,
        $symVar = 0,
        \DateTime $date = NULL,
        \DateTime $dateTax = NULL,
        \DateTime $dateAccounting = NULL,
        \DateTime $dateDue = NULL,
        $accountingId = 0,
        $accountingIds = '',
        $classificationVatId = 0,
        $classificationVatIds = '',
        $classificationVatType = '',
        $text = '',
        $partnerIdentityId = 0,
        Address $partnerIdentityAddress = NULL,
        Address $myIdentityAddress = NULL,
        $paymentTypeId = 0,
        $paymentTypeIds = '',
        $paymentType = '',
        $accountId = 0,
        $accountIds = '',
        $accountBankCode = '',
        $accountNo = '',
        $symConst = '',
        $liquidationAmountHome = 0.0,
        $markRecord = FALSE,
        $note = '',
        $intNote = '',
        $centreIds = '',
        $activityIds = ''
    )
    {
        $this->id = $id;
        $this->invoiceType = $invoiceType;
        $this->numberRequested = $numberRequested;
        $this->symVar = $symVar;

        $this->setDate($date);
        $this->setDateAccounting($dateAccounting);
        $this->setDateDue($dateDue);
        $this->setDateTax($dateTax);

        $this->accountingId = $accountingId;
        $this->accountingIds = $accountingIds;
        $this->classificationVatId = $classificationVatId;
        $this->classificationVatIds = $classificationVatIds;
        $this->classificationVatType = $classificationVatType;
        $this->text = $text;
        $this->partnerIdentityId = $partnerIdentityId;
        $this->partnerIdentityAddress = $partnerIdentityAddress;
        $this->myIdentityAddress = $myIdentityAddress;
        $this->paymentTypeId = $paymentTypeId;
        $this->paymentTypeIds = $paymentTypeIds;
        $this->paymentType = $paymentType;
        $this->accountId = $accountId;
        $this->accountIds = $accountIds;
        $this->accountNo = $accountNo;
        $this->symConst = $symConst;
        $this->liquidationAmountHome = $liquidationAmountHome;
        $this->markRecord = $markRecord;
        $this->note = $note;
        $this->intNote = $intNote;
        $this->centreIds = $centreIds;
        $this->activityIds = $activityIds;
        $this->accountBankCode = $accountBankCode;
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
    public function getInvoiceType()
    {
        return $this->invoiceType;
    }

    /**
     * @param string $invoiceType
     */
    public function setInvoiceType($invoiceType)
    {
        $this->invoiceType = $invoiceType;
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
     * @return int
     */
    public function getSymVar()
    {
        return $this->symVar;
    }

    /**
     * @param int $symVar
     */
    public function setSymVar($symVar)
    {
        $this->symVar = $symVar;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date = NULL)
    {
        $this->date = PohodaHelper::formatDate($date, FALSE);
    }

    /**
     * @return string
     */
    public function getDateTax()
    {
        return $this->dateTax;
    }

    /**
     * @param \DateTime $dateTax
     */
    public function setDateTax(\DateTime $dateTax = NULL)
    {
        $this->dateTax = PohodaHelper::formatDate($dateTax, FALSE);
    }

    /**
     * @return string
     */
    public function getDateAccounting()
    {
        return $this->dateAccounting;
    }

    /**
     * @param \DateTime $dateAccounting
     */
    public function setDateAccounting(\DateTime $dateAccounting = NULL)
    {
        $this->dateAccounting = PohodaHelper::formatDate($dateAccounting, FALSE);
    }

    /**
     * @return string
     */
    public function getDateDue()
    {
        return $this->dateDue;
    }

    /**
     * @param \DateTime $dateDue
     */
    public function setDateDue(\DateTime $dateDue = NULL)
    {
        $this->dateDue = PohodaHelper::formatDate($dateDue, FALSE);
    }

    /**
     * @return int
     */
    public function getAccountingId()
    {
        return $this->accountingId;
    }

    /**
     * @param int $accountingId
     */
    public function setAccountingId($accountingId)
    {
        $this->accountingId = $accountingId;
    }

    /**
     * @return string
     */
    public function getAccountingIds()
    {
        return $this->accountingIds;
    }

    /**
     * @param string $accountingIds
     */
    public function setAccountingIds($accountingIds)
    {
        $this->accountingIds = $accountingIds;
    }

    /**
     * @return int
     */
    public function getClassificationVatId()
    {
        return $this->classificationVatId;
    }

    /**
     * @param int $classificationVatId
     */
    public function setClassificationVatId($classificationVatId)
    {
        $this->classificationVatId = $classificationVatId;
    }

    /**
     * @return string
     */
    public function getClassificationVatIds()
    {
        return $this->classificationVatIds;
    }

    /**
     * @param string $classificationVatIds
     */
    public function setClassificationVatIds($classificationVatIds)
    {
        $this->classificationVatIds = $classificationVatIds;
    }

    /**
     * @return string
     */
    public function getClassificationVatType()
    {
        return $this->classificationVatType;
    }

    /**
     * @param string $classificationVatType
     */
    public function setClassificationVatType($classificationVatType)
    {
        $this->classificationVatType = $classificationVatType;
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
    public function setMyIdentityAddress($myIdentityAddress)
    {
        $this->myIdentityAddress = $myIdentityAddress;
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
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getAccountIds()
    {
        return $this->accountIds;
    }

    /**
     * @param string $accountIds
     */
    public function setAccountIds($accountIds)
    {
        $this->accountIds = $accountIds;
    }

    /**
     * @return string
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @param string $accountNo
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;
    }

    /**
     * @return string
     */
    public function getSymConst()
    {
        return $this->symConst;
    }

    /**
     * @param string $symConst
     */
    public function setSymConst($symConst)
    {
        $this->symConst = $symConst;
    }

    /**
     * @return float
     */
    public function getLiquidationAmountHome()
    {
        return $this->liquidationAmountHome;
    }

    /**
     * @param float $liquidationAmountHome
     */
    public function setLiquidationAmountHome($liquidationAmountHome)
    {
        $this->liquidationAmountHome = $liquidationAmountHome;
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
     * @return string
     */
    public function getIntNote()
    {
        return $this->intNote;
    }

    /**
     * @param string $intNote
     */
    public function setIntNote($intNote)
    {
        $this->intNote = $intNote;
    }

    /**
     * @return string
     */
    public function getCentreIds()
    {
        return $this->centreIds;
    }

    /**
     * @param string $centreIds
     */
    public function setCentreIds($centreIds)
    {
        $this->centreIds = $centreIds;
    }

    /**
     * @return string
     */
    public function getActivityIds()
    {
        return $this->activityIds;
    }

    /**
     * @param string $activityIds
     */
    public function setActivityIds($activityIds)
    {
        $this->activityIds = $activityIds;
    }

    /**
     * @return string
     */
    public function getAccountBankCode()
    {
        return $this->accountBankCode;
    }

    /**
     * @param string $accountBankCode
     */
    public function setAccountBankCode($accountBankCode)
    {
        $this->accountBankCode = $accountBankCode;
    }
}