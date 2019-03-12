<?php

namespace AccSync\Pohoda\Entity;

class Address
{
    /**
     * @var string $company
     */
    private $company;
    /**
     * @var string $division
     */
    private $division;
    /**
     * @var string $firstName
     */
    private $firstName;
    /**
     * @var string $lastName
     */
    private $lastName;
    /**
     * @var string $city
     */
    private $city;
    /**
     * @var string $street
     */
    private $street;
    /**
     * @var string $streetNumber
     */
    private $streetNumber;
    /**
     * @var string $zip
     */
    private $zip;
    /**
     * @var string $ico
     */
    private $ico;
    /**
     * @var string $dic
     */
    private $dic;
    /**
     * @var string $phone
     */
    private $phone;
    /**
     * @var string $mobilPhone
     */
    private $mobilPhone;
    /**
     * @var string $fax
     */
    private $fax;
    /**
     * @var string $email
     */
    private $email;
    /**
     * @var string $www
     */
    private $www;
    /**
     * @var string $shipToCompany
     */
    private $shipToCompany;
    /**
     * @var string $shipToFirstName
     */
    private $shipToName;
    /**
     * @var string $shipToCity
     */
    private $shipToCity;
    /**
     * @var string $shipToZip
     */
    private $shipToZip;
    /**
     * @var string $shipToStreet
     */
    private $shipToStreet;
    /**
     * @var string $shipToPhone
     */
    private $shipToPhone;

    /**
     * Address constructor.
     *
     * @param string $company
     * @param string $division
     * @param string $firstName
     * @param string $lastName
     * @param string $city
     * @param string $street
     * @param string $streetNumber
     * @param string $zip
     * @param string $ico
     * @param string $dic
     * @param string $phone
     * @param string $mobilPhone
     * @param string $fax
     * @param string $email
     * @param string $www
     * @param string $shipToCompany
     * @param string $shipToName
     * @param string $shipToCity
     * @param string $shipToZip
     * @param string $shipToStreet
     * @param string $shipToPhone
     */
    public function __construct(
        $company = '',
        $division = '',
        $firstName = '',
        $lastName = '',
        $city = '',
        $street = '',
        $streetNumber = '',
        $zip = '',
        $ico = '',
        $dic = '',
        $phone = '',
        $mobilPhone = '',
        $fax = '',
        $email = '',
        $www = '',
        $shipToCompany = '',
        $shipToName = '',
        $shipToCity = '',
        $shipToZip = '',
        $shipToStreet = '',
        $shipToPhone = ''
    )
    {
        $this->company = $company;
        $this->division = $division;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->city = $city;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->zip = $zip;
        $this->ico = $ico;
        $this->dic = $dic;
        $this->phone = $phone;
        $this->mobilPhone = $mobilPhone;
        $this->fax = $fax;
        $this->email = $email;
        $this->www = $www;
        $this->shipToCompany = $shipToCompany;
        $this->shipToName = $shipToName;
        $this->shipToCity = $shipToCity;
        $this->shipToZip = $shipToZip;
        $this->shipToStreet = $shipToStreet;
        $this->shipToPhone = $shipToPhone;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @param string $division
     */
    public function setDivision($division)
    {
        $this->division = $division;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getIco()
    {
        return $this->ico;
    }

    /**
     * @param string $ico
     */
    public function setIco($ico)
    {
        $this->ico = $ico;
    }

    /**
     * @return string
     */
    public function getDic()
    {
        return $this->dic;
    }

    /**
     * @param string $dic
     */
    public function setDic($dic)
    {
        $this->dic = $dic;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getMobilPhone()
    {
        return $this->mobilPhone;
    }

    /**
     * @param string $mobilPhone
     */
    public function setMobilPhone($mobilPhone)
    {
        $this->mobilPhone = $mobilPhone;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * @param string $www
     */
    public function setWww($www)
    {
        $this->www = $www;
    }

    /**
     * @return string
     */
    public function getShipToCompany()
    {
        return $this->shipToCompany;
    }

    /**
     * @param string $shipToCompany
     */
    public function setShipToCompany($shipToCompany)
    {
        $this->shipToCompany = $shipToCompany;
    }

    /**
     * @return string
     */
    public function getShipToName()
    {
        return $this->shipToName;
    }

    /**
     * @param string $shipToName
     */
    public function setShipToName($shipToName)
    {
        $this->shipToName = $shipToName;
    }

    /**
     * @return string
     */
    public function getShipToCity()
    {
        return $this->shipToCity;
    }

    /**
     * @param string $shipToCity
     */
    public function setShipToCity($shipToCity)
    {
        $this->shipToCity = $shipToCity;
    }

    /**
     * @return string
     */
    public function getShipToZip()
    {
        return $this->shipToZip;
    }

    /**
     * @param string $shipToZip
     */
    public function setShipToZip($shipToZip)
    {
        $this->shipToZip = $shipToZip;
    }

    /**
     * @return string
     */
    public function getShipToStreet()
    {
        return $this->shipToStreet;
    }

    /**
     * @param string $shipToStreet
     */
    public function setShipToStreet($shipToStreet)
    {
        $this->shipToStreet = $shipToStreet;
    }

    /**
     * @return string
     */
    public function getShipToPhone()
    {
        return $this->shipToPhone;
    }

    /**
     * @param string $shipToPhone
     */
    public function setShipToPhone($shipToPhone)
    {
        $this->shipToPhone = $shipToPhone;
    }
}