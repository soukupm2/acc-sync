<?php

require './vendor/autoload.php';

class PohodaTest extends PHPUnit_Framework_TestCase
{
    const BASE_URI = 'localhost';
    const USERNAME = '@';
    const PASSWORD = '';
    const COMPANY_ID = 12345678;
    const PORT = '1111';

    /**
     * Creates proper connection to Pohoda
     * @return \AccSync\Pohoda\PohodaConnector
     */
    private function createProperConnection()
    {
        $connectionFactory = new \AccSync\Pohoda\PohodaConnectionFactory(
            self::BASE_URI,
            self::USERNAME,
            self::PASSWORD,
            self::COMPANY_ID,
            self::PORT);

        $connection = $connectionFactory->create();

        return $connection;
    }

    /**
     * Removes XML attributes and comments from stdClass
     *
     * @param stdClass $items
     * @return stdClass
     */
    private function removeAttributes(\stdClass &$items)
    {
        if (isset($items->{'@attributes'}))
        {
            unset($items->{'@attributes'});
        }
        if (isset($items->comment))
        {
            unset($items->comment);
        }

        foreach ($items as $item)
        {
            if ($item instanceof \stdClass)
            {
                $this->removeAttributes($item);
            }
        }

        return $items;
    }

    /**
     * Checks two strings created from XML if they have same values
     * Converted to array
     *
     * @param string $expectedXmlString
     * @param string $actualXmlString
     */
    private function checkXmlValues($expectedXmlString, $actualXmlString)
    {
        $expectedRequestArray = \AccSync\Pohoda\Data\XMLParser::parseXML($expectedXmlString);
        $this->removeAttributes($expectedRequestArray);
        $expectedRequestArray = json_decode(json_encode($expectedRequestArray), true);

        $actualRequestArray = \AccSync\Pohoda\Data\XMLParser::parseXML($actualXmlString);
        $this->removeAttributes($actualRequestArray);
        $actualRequestArray = json_decode(json_encode($actualRequestArray), true);

        $this->assertSame($expectedRequestArray, $actualRequestArray);
    }

    /**
     * Loads the template with expected input / output XML
     *
     * @param $template
     * @return DOMDocument
     */
    private function loadTemplate($template)
    {
        $dom = new \DOMDocument();
        $path = realpath (__DIR__ . '/' . $template);
        $dom->load($path, LIBXML_PARSEHUGE);

        return $dom;
    }

    /**
     * Test if the connection returns correct instance of class
     */
    public function testCreateConnection()
    {
        $connection = $this->createProperConnection();

        $this->assertInstanceOf(\AccSync\Pohoda\PohodaConnector::class, $connection);
    }

    /**
     * Creation of connector with invalid Base URI
     */
    public function testCreateConnectionWithNoBaseUri()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('BaseUri cannot be empty');

        new \AccSync\Pohoda\PohodaConnectionFactory(
            NULL,
            self::USERNAME,
            self::PASSWORD,
            self::COMPANY_ID,
            self::PORT);
    }

    /**
     * Creation of connector with invalid Username
     */
    public function testCreateConnectionWithNoUsername()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Username cannot be empty');

        new \AccSync\Pohoda\PohodaConnectionFactory(
            self::BASE_URI,
            NULL,
            self::PASSWORD,
            self::COMPANY_ID,
            self::PORT);
    }

    /**
     * Creation of connector with invalid Company ID
     */
    public function testCreateConnectionWithNoCompanyId()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Company ID cannot be empty');

        new \AccSync\Pohoda\PohodaConnectionFactory(
            self::BASE_URI,
            self::USERNAME,
            self::PASSWORD,
            NULL,
            self::PORT);
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by code = 'Z220'
     */
    public function testListStockRequestCode()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest('1', 12345678);
        $request->addFilter(\AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest::FILTER_BY_SUPPLY_CODE, 'Z220');

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_01_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by code = 'Z220'
     */
    public function testListStockResponseByCode()
    {
        $connection = $this->createProperConnection();

        $connection->setListStockRequest()
            ->addFilter(\AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest::FILTER_BY_SUPPLY_CODE, 'Z220');

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_01_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by code = 'Z220'
     */
    public function testListStockRequestStoreNames()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest('1', 12345678);
        $request->addFilterStoreName(['MATERIÁL']);

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_02_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by store:ids = 'MATERIÁL'
     */
    public function testListStockResponseByStoreNames()
    {
        $connection = $this->createProperConnection();

        $connection->setListStockRequest()
            ->addFilterStoreName(['MATERIÁL']);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_02_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by storage:ids = ['ZBOŽÍ/Nábytek/Pro firmy']
     */
    public function testListStockRequestStorage()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest('1', 12345678);
        $request->addFilterStorage(['ZBOŽÍ/Nábytek/Pro firmy']);

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_03_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by storage:ids = ['ZBOŽÍ/Nábytek/Pro firmy']
     */
    public function testListStockResponseByStorage()
    {
        $connection = $this->createProperConnection();

        $connection->setListStockRequest()
            ->addFilterStorage(['ZBOŽÍ/Nábytek/Pro firmy']);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_03_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by internet == true
     */
    public function testListStockRequestInternetTrue()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest('1', 12345678);
        $request->addFilter(\AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest::FILTER_BY_STORE_INTERNET, 'true');

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_04_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by internet == true
     */
    public function testListStockResponseByInternetTrue()
    {
        $connection = $this->createProperConnection();

        $connection->setListStockRequest()
            ->addFilter(\AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest::FILTER_BY_STORE_INTERNET, 'true');

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_04_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by store:id = 1
     */
    public function testListStockRequestStoreIds()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest('1', 12345678);
        $request->addFilterStoreIds([1]);

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_05_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by store:id = 1
     */
    public function testListStockResponseByStoreIds()
    {
        $connection = $this->createProperConnection();

        $connection->setListStockRequest()
            ->addFilterStoreIds([1]);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Stock/zasoby_05_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by dateFrom = 2018-01-21 and dateTill = 2018-01-23
     */
    public function testListOrderRequestDateRange()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest(
            '1',
            12345678,
            \AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest::ORDER_TYPE_RECEIVED
        );

        $dateFrom = new \DateTime('2018-01-21');
        $dateTo= new \DateTime('2018-01-23');

        $request->addFilterDateRange($dateFrom, $dateTo);

        $dom = $this->loadTemplate('PohodaXML/Orders/objednavky_01_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by dateFrom = 2018-01-21 and dateTill = 2018-01-23
     */
    public function testListOrderResponseByDateRange()
    {
        $dateFrom = new \DateTime('2018-01-21');
        $dateTo= new \DateTime('2018-01-23');

        $connection = $this->createProperConnection();

        $connection->setListOrderRequest(\AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest::ORDER_TYPE_RECEIVED)
            ->addFilterDateRange($dateFrom, $dateTo);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Orders/objednavky_01_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by ICO = 85236972
     */
    public function testListOrderRequestIco()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest(
            '1',
            12345678,
            \AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest::ORDER_TYPE_RECEIVED
        );

        $request->addFilterIns([85236972]);

        $dom = $this->loadTemplate('PohodaXML/Orders/objednavky_02_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by ICO = 85236972
     */
    public function testListOrderResponseByIco()
    {
        $connection = $this->createProperConnection();

        $connection->setListOrderRequest(\AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest::ORDER_TYPE_RECEIVED)
            ->addFilterIns([85236972]);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Orders/objednavky_02_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by ICO = 85236972
     */
    public function testListOrderRequestIcoIssued()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest(
            '1',
            12345678,
            \AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest::ORDER_TYPE_ISSUED
        );

        $request->addFilterIns([85236972]);

        $dom = $this->loadTemplate('PohodaXML/Orders/objednavky_02_v2.0_issued.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by ICO = 85236972
     */
    public function testListOrderResponseByIcoIssued()
    {
        $connection = $this->createProperConnection();

        $connection->setListOrderRequest(\AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest::ORDER_TYPE_ISSUED)
            ->addFilterIns([85236972]);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Orders/objednavky_02_v2.0_issued_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by ICO = 85236972
     */
    public function testListInvoiceRequestIco()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest(
            '1',
            12345678,
            \AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest::INVOICE_TYPE_ISSUED
        );

        $request->addFilterIns(85236972);

        $dom = $this->loadTemplate('PohodaXML/Invoices/faktury_02_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by ICO = 85236972
     */
    public function testListInvoiceResponseByIco()
    {
        $connection = $this->createProperConnection();

        $connection->setListInvoiceRequest(\AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest::INVOICE_TYPE_ISSUED)
            ->addFilterIns(85236972);

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Invoices/faktury_02_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by Company name = AK - Media a. s.
     */
    public function testListInvoiceRequestCompany()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest(
            '1',
            12345678,
            \AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest::INVOICE_TYPE_ISSUED
        );

        $request->addFilterCompanyName('AK - Media a. s.');

        $dom = $this->loadTemplate('PohodaXML/Invoices/faktury_03_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by Company name = AK - Media a. s.
     */
    public function testListInvoiceResponseByCompany()
    {
        $connection = $this->createProperConnection();

        $connection->setListInvoiceRequest(\AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest::INVOICE_TYPE_ISSUED)
            ->addFilterCompanyName('AK - Media a. s.');

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Invoices/faktury_03_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }

    /**
     * Test, which compares expected request format and values with actual format from Pohoda accounting system
     *
     * Filter by ICO = 85236972, Company name = AK - Media a. s.
     */
    public function testListInvoiceRequestCompanyAndIco()
    {
        $request = new \AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest(
            '1',
            12345678,
            \AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest::INVOICE_TYPE_ISSUED
        );

        $request->addFilterIns(85236972);
        $request->addFilterCompanyName('AK - Media a. s.');

        $dom = $this->loadTemplate('PohodaXML/Invoices/faktury_04_v2.0.xml');

        $domRequest = dom_import_simplexml($request->getRequestXml());

        $this->assertEqualXMLStructure($dom->documentElement, $domRequest);

        $this->checkXmlValues($dom->saveXML(), $request->getRequestXml()->saveXML());
    }

    /**
     * Test, which compares expected response with actual response from Pohoda accounting system
     *
     * Filter by ICO = 85236972, Company name = AK - Media a. s.
     */
    public function testListInvoiceResponseByCompanyAndIco()
    {
        $connection = $this->createProperConnection();

        $connection->setListInvoiceRequest(\AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest::INVOICE_TYPE_ISSUED)
            ->addFilterIns(85236972)
            ->addFilterCompanyName('AK - Media a. s.');

        $connection->sendRequest();

        $dom = $this->loadTemplate('PohodaXML/Invoices/faktury_04_v2.0_response.xml');

        $this->assertEqualXMLStructure($dom->documentElement, $connection->getDOMResponse()->documentElement);

        $this->checkXmlValues($dom->saveXML(), $connection->getDOMResponse()->saveXML());
    }
}