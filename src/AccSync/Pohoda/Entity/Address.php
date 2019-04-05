<?php

namespace AccSync\Pohoda\Entity;

/**
 * Class Address
 *
 * @package AccSync\Pohoda\Entity
 * @author  miroslav.soukup2@gmail.com
 */
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
     * @var string $name
     */
    private $name;
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
}