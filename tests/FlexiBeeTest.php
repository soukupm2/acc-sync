<?php

require './vendor/autoload.php';

/**
 * Class FlexiBeeTest
 * run: ./vendor/bin/phpunit tests/FlexiBeeTest.php
 */
class FlexiBeeTest extends PHPUnit_Framework_TestCase
{
    const BASE_URI = 'https://demo.flexibee.eu';
    const USERNAME = 'winstrom';
    const PASSWORD = 'winstrom';
    const COMPANY_ID = 'demo_sk';

    /**
     * Creates proper connection to Pohoda
     *
     * @return \AccSync\FlexiBee\FlexiBeeConnector
     */
    private function createProperConnection()
    {
        $connectionFactory = new \AccSync\FlexiBee\FlexiBeeConnectionFactory(
            self::BASE_URI,
            self::USERNAME,
            self::PASSWORD,
            self::COMPANY_ID);

        $connection = $connectionFactory->create();

        return $connection;
    }

    /**
     * Test if the connection returns correct instance of class
     */
    public function testCreateConnection()
    {
        $connection = $this->createProperConnection();

        $this->assertInstanceOf(\AccSync\FlexiBee\FlexiBeeConnector::class, $connection);
    }

    /**
     * Creation of connector with invalid Base URI
     */
    public function testCreateConnectionWithNoBaseUri()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('BaseUri cannot be empty');

        new \AccSync\FlexiBee\FlexiBeeConnectionFactory(
            NULL,
            self::USERNAME,
            self::PASSWORD,
            self::COMPANY_ID
        );
    }
    /**
     * Creation of connector with invalid Username
     */
    public function testCreateConnectionWithNoUsername()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Username cannot be empty');

        new \AccSync\FlexiBee\FlexiBeeConnectionFactory(
            self::BASE_URI,
            NULL,
            self::PASSWORD,
            self::COMPANY_ID
        );
    }

    /**
     * Creation of connector with invalid Company ID
     */
    public function testCreateConnectionWithNoCompanyId()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Company ID cannot be empty');

        new \AccSync\FlexiBee\FlexiBeeConnectionFactory(
            self::BASE_URI,
            self::USERNAME,
            self::PASSWORD,
            NULL
        );
    }

    /**
     * Get price list request test
     */
    public function testGetPriceListResponse()
    {
        $connection = $this->createProperConnection();

        $request = $connection->getPriceList()
            ->setLimit(5);

        $result = $connection->sendRequest();

        $count = count($result);

        $this->assertEquals('cenik', $request->getRegister());
        $this->assertLessThanOrEqual(5, $count);
        $this->assertEquals(FALSE, $connection->hasError());
    }

    /**
     * Get received invoices request test
     */
    public function testGetReceivedInvoicesResponse()
    {
        $connection = $this->createProperConnection();

        $request = $connection->getReceivedInvoices()
            ->setLimit(10);

        $result = $connection->sendRequest();

        $count = count($result);

        $this->assertEquals('faktura-prijata', $request->getRegister());
        $this->assertLessThanOrEqual(10, $count);
        $this->assertEquals(FALSE, $connection->hasError());
    }

    /**
     * Get issued invoices request test
     */
    public function testGetIssuedInvoicesResponse()
    {
        $connection = $this->createProperConnection();

        $request = $connection->getIssuedInvoices()
            ->setLimit(15);

        $result = $connection->sendRequest();

        $count = count($result);

        $this->assertEquals('faktura-vydana', $request->getRegister());
        $this->assertLessThanOrEqual(15, $count);
        $this->assertEquals(FALSE, $connection->hasError());
    }

    /**
     * Get issued invoices request test
     */
    public function testGetIssuedOrdersResponse()
    {
        $connection = $this->createProperConnection();

        $request = $connection->getIssuedOrders()
            ->setLimit(15);

        $result = $connection->sendRequest();

        $count = count($result);

        $this->assertEquals('objednavka-vydana', $request->getRegister());
        $this->assertLessThanOrEqual(15, $count);
        $this->assertEquals(FALSE, $connection->hasError());
    }

    /**
     * Get issued invoices request test
     */
    public function testGetReceivedOrdersResponse()
    {
        $connection = $this->createProperConnection();

        $request = $connection->getReceivedOrders()
            ->setLimit(15);

        $result = $connection->sendRequest();

        $count = count($result);

        $this->assertEquals('objednavka-prijata', $request->getRegister());
        $this->assertLessThanOrEqual(15, $count);
        $this->assertEquals(FALSE, $connection->hasError());
    }

    /**
     * Get issued invoices request test
     */
    public function testGetIssuedInvoicesWrongIdResponse()
    {
        $connection = $this->createProperConnection();

        $filter = new \AccSync\FlexiBee\UrlFilter\FlexiBeeCondition();
        $filter->setIdentifier('id');
        $filter->setOperator(\AccSync\FlexiBee\Enum\EOperators::EQUAL);
        $filter->setValue('wrong');

        $connection->getIssuedInvoices()
            ->setUrlFilter($filter->getFullCondition())
            ->setLimit(15);

        $connection->sendRequest();

        $this->assertEquals(TRUE, $connection->hasError());
    }

    /**
     * Get issued invoices request test
     */
    public function testGetIssuedInvoicesCorrectIdResponse()
    {
        $connection = $this->createProperConnection();

        $filter = new \AccSync\FlexiBee\UrlFilter\FlexiBeeCondition();
        $filter->setIdentifier('id');
        $filter->setOperator(\AccSync\FlexiBee\Enum\EOperators::EQUAL);
        $filter->setValue(1);

        $connection->getIssuedInvoices()
            ->setUrlFilter($filter->getFullCondition());

        $result = $connection->sendRequest();

        $this->assertEquals(FALSE, $connection->hasError());

        if (!empty($result))
        {
            $id = ($result[0])->id;
            $this->assertEquals(1, $id);
        }
        else
        {
            $this->assertEmpty($result);
        }
    }

    /**
     * Send price list item test
     */
    public function testSendPriceListItem()
    {
        $connection = $this->createProperConnection();

        $connection->sendPriceListItem()
            ->setId(42)
            ->setCode('testing')
            ->setName('testing')
            ->setBasePrice(100)
            ->setVatRate(20);

        $connection->sendRequest();

        $this->assertEquals(FALSE, $connection->hasError());
    }

    /**
     * Send issude invoce item test
     */
    public function testSendIssuedInvoiceItem()
    {
        $connection = $this->createProperConnection();

        $connection->sendIssuedInvoiceRequest()
            ->setId(140)
            ->setCode('00000005/19-1')
            ->setDescription('testing')
            ->setLeftToPay(100)
            ->setType('code:FAKTURA')
            ->setDueDate('2019')
            ->setReceivedNumber(1234);

        $connection->sendRequest();

        $this->assertEquals(FALSE, $connection->hasError());
    }
}