<?php

namespace AccSync\Pohoda;

use AccSync\Connector;
use AccSync\Pohoda\Collection\Invoice\InvoicesCollection;
use AccSync\Pohoda\Data\ErrorParser;
use AccSync\Pohoda\Data\XMLParser;
use AccSync\Pohoda\Enum\EResponseErrorCodes;
use AccSync\Pohoda\Exception\PohodaConnectionException;
use AccSync\Pohoda\Requests\BaseRequest;
use AccSync\Pohoda\Requests\GetDataRequest\ListInvoiceRequest;
use AccSync\Pohoda\Requests\GetDataRequest\ListOrderRequest;
use AccSync\Pohoda\Requests\GetDataRequest\ListStockRequest;
use AccSync\Pohoda\Requests\SendDataRequest\SendInvoiceRequest;
use phpDocumentor\Reflection\Types\This;

/**
 * Class PohodaConnector
 *
 * @package AccSync\Pohoda
 * @author  miroslav.soukup2@gmail.com
 */
class PohodaConnector extends Connector
{
    /**
     * @var BaseRequest $request
     */
    private $request;
    /**
     * @var \DOMDocument $domResponse
     */
    private $domResponse = NULL;
    /**
     * @var \stdClass $parsedResponse
     */
    private $parsedResponse = NULL;
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
     * @throws PohodaConnectionException|\BadMethodCallException
     */
    private function verifySuccess()
    {
        if (empty($this->curl))
        {
            throw new \BadMethodCallException('curl not initialized');
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

        $response = $this->getCurlResponse($this->request);

        $this->verifySuccess();

        $dom = new \DOMDocument();
        $dom->loadXML($response, LIBXML_PARSEHUGE);

        $this->domResponse = $dom;

        $result = XMLParser::parseXML($dom->saveXML());

        $this->parsedResponse = $result;

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
     * @return \stdClass
     */
    public function getParsedResponse()
    {
        return $this->parsedResponse;
    }

    /**
     * Returns error description if there is any
     *
     * @return string|null
     */
    public function getError()
    {
        if (empty($this->parsedResponse))
        {
            return NULL;
        }

        return ErrorParser::parse($this->parsedResponse);
    }

    /**
     * @param BaseRequest $request
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
}