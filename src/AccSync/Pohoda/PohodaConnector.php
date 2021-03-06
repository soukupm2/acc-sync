<?php

namespace AccSync\Pohoda;

use AccSync\Connector;
use AccSync\Data\ErrorParser;
use AccSync\Pohoda\Collection\Invoice\InvoicesCollection;
use AccSync\Pohoda\Collection\Order\OrdersCollection;
use AccSync\Pohoda\Collection\Stock\StockCollection;
use AccSync\Pohoda\Data\XMLParser;
use AccSync\Pohoda\Enum\EResponseErrorCodes;
use AccSync\Pohoda\Exception\PohodaConnectionException;
use AccSync\Pohoda\Requests\BaseRequest;
use AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest;
use AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest;
use AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest;
use AccSync\Pohoda\Requests\SendDataRequest\SendInvoiceRequest;
use AccSync\Pohoda\Requests\SendDataRequest\SendOrderRequest;
use AccSync\Pohoda\Requests\SendDataRequest\SendStockRequest;

/**
 * Class PohodaConnector
 *
 * @package AccSync\Pohoda
 * @author  miroslav.soukup2@gmail.com
 */
class PohodaConnector extends Connector
{
    /**
     * @var \DOMDocument $domResponse
     */
    private $domResponse = NULL;
    /**
     * @var int Default number of request
     */
    private $requestId = 1;

    /**
     * PohodaConnector constructor.
     *
     * @param string      $baseUri   URI - expected format http://localhost
     * @param string      $username  User login name
     * @param string      $password  User login password
     * @param string      $companyId Company unique identifier
     * @param string|null $port      Port number for communication
     */
    public function __construct($baseUri, $username, $password, $companyId, $port = NULL)
    {
        $this->baseUri = $baseUri;
        $this->username = $username;
        $this->password = $password;
        $this->companyId = $companyId;
        $this->port = $port;

        parent::__construct();
    }

    /**
     * Creates full URL for request
     *
     * @return string
     */
    private function createUrl()
    {
        $port = !empty($this->port) ? ':' . $this->port : NULL;

        return $this->baseUri . $port . '/xml';
    }

    /**
     * Sends
     *
     * @param BaseRequest $request
     *
     * @return bool|string
     */
    private function getCurlResponse(BaseRequest $request)
    {
        $xml = $request->getRequestXml()->asXML();

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $xml);

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'STW-Authorization: ' . $this->createAuthToken(),
            'Content-Type: text/xml',
            'Content-Length: ' . strlen($xml)
        ]);

        return curl_exec($this->curl);
    }

    /**
     * @inheritdoc
     */
    protected function curlInit()
    {
        parent::curlInit();

        curl_setopt($this->curl, CURLOPT_USERAGENT, $this->companyId);
        curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($this->curl, CURLOPT_URL, $this->createUrl());
        curl_setopt($this->curl, CURLOPT_POST, TRUE);
    }

    /**
     * Returns an error if there is one otherwise empty string
     *
     * @throws PohodaConnectionException
     */
    private function verifySuccess()
    {
        if (empty($this->curl))
        {
            throw new PohodaConnectionException('curl not initialized');
        }
        else
        {
            $errNo = curl_errno($this->curl);
            $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

            if (in_array($httpCode, EResponseErrorCodes::$errorCodes))
            {
                throw new PohodaConnectionException(EResponseErrorCodes::$errorCodesToString[$httpCode], $httpCode);
            }
            elseif ($errNo !== 0)
            {
                $errString = (string)curl_error($this->curl);
                throw new PohodaConnectionException($errString, $errNo);
            }
        }
    }

    /**
     * Sends the request to Pohoda API
     * Returns \stdClass with the result data
     *
     * @return \stdClass
     * @throws PohodaConnectionException
     */
    public function sendRequest()
    {
        if (empty($this->request))
        {
            throw new PohodaConnectionException('Request has not been set.');
        }

        $this->hasError = FALSE;
        $this->error = NULL;

        $response = $this->getCurlResponse($this->request);

        $this->verifySuccess();

        $dom = new \DOMDocument();
        $dom->loadXML($response, LIBXML_PARSEHUGE);

        $this->domResponse = $dom;

        $result = XMLParser::parseXML($dom->saveXML());

        $this->stdClassResponse = $result;

        $this->setUpError();

        return $result;
    }

    /**
     * Returns original non-parsed DOM response from client
     *
     * @return \DOMDocument
     */
    public function getDOMResponse()
    {
        return $this->domResponse;
    }

    /**
     * @inheritDoc
     */
    protected function setUpError()
    {
        if (empty($this->stdClassResponse))
        {
            $this->hasError = FALSE;
            $this->error = 'Empty response';
        }

        $parsedError = ErrorParser::parsePohoda($this->stdClassResponse);

        if ($parsedError !== NULL)
        {
            $this->hasError = TRUE;
            $this->error = $parsedError;
        }
    }

    /**
     * @param BaseRequest $request
     * @return PohodaConnector
     */
    public function setCustomRequest(BaseRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return ListStockRequest
     */
    public function setListStockRequest()
    {
        $this->request = new ListStockRequest($this->requestId, $this->companyId);

        $this->requestId ++;

        return $this->request;
    }

    /**
     * @param string $orderType
     * @return ListOrderRequest
     */
    public function setListOrderRequest($orderType)
    {
        $this->request = new ListOrderRequest($this->requestId, $this->companyId, $orderType);

        $this->requestId ++;

        return $this->request;
    }

    /**
     * @param string $invoiceType
     * @return ListInvoiceRequest
     */
    public function setListInvoiceRequest($invoiceType)
    {
        $this->request = new ListInvoiceRequest($this->requestId, $this->companyId, $invoiceType);

        $this->requestId ++;

        return $this->request;
    }

    /**
     * @param InvoicesCollection $invoicesCollection
     * @return SendInvoiceRequest
     */
    public function setSendInvoiceRequest(InvoicesCollection $invoicesCollection)
    {
        $this->request = new SendInvoiceRequest($this->requestId, $this->companyId, $invoicesCollection);

        $this->requestId ++;

        return $this->request;
    }

    /**
     * @param OrdersCollection $ordersCollection
     * @return SendOrderRequest
     */
    public function setSendOrdersRequest(OrdersCollection $ordersCollection)
    {
        $this->request = new SendOrderRequest($this->requestId, $this->companyId, $ordersCollection);

        $this->requestId ++;

        return $this->request;
    }

    /**
     * @param StockCollection $stockCollection
     * @return SendStockRequest
     */
    public function setSendStockRequest(StockCollection $stockCollection)
    {
        $this->request = new SendStockRequest($this->requestId, $this->companyId, $stockCollection);

        $this->requestId ++;

        return $this->request;
    }
}