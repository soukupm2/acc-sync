<?php

namespace AccSync\FlexiBee;

use AccSync\Connector;
use AccSync\Data\ErrorParser;
use AccSync\FlexiBee\Data\FlexiBeeParser;
use AccSync\FlexiBee\Exception\FlexiBeeConnectionException;
use AccSync\FlexiBee\Requests\BaseRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\BaseGetDataRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\IssuedInvoiceRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\PriceListRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\ReceivedInvoiceRequest;
use AccSync\FlexiBee\Requests\SendDataRequest\BaseSendDataRequest;
use AccSync\FlexiBee\Requests\SendDataRequest\SendIssuedInvoiceRequest;
use AccSync\FlexiBee\Requests\SendDataRequest\SendPriceItemRequest;

/**
 * Class FlexiBeeConnector
 *
 * @package AccSync\FlexiBee
 * @author miroslav.soukup2@gmail.com
 */
class FlexiBeeConnector extends Connector
{
    /**
     * FlexiBeeConnector constructor.
     *
     * @param string $baseUri URI - expected format http://localhost
     * @param string $username User login name
     * @param string $password User login password
     * @param string $companyId
     * @param string $port Number of port for communication
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

    private function getBaseUrl()
    {
        $port = !empty($this->port) ? ':' . $this->port : NULL;

        return $this->baseUri . $port . '/c/' . $this->companyId . '/';
    }

    /**
     * @inheritdoc
     */
    protected function curlInit()
    {
        parent::curlInit();

        curl_setopt($this->curl, CURLOPT_HTTPAUTH, true);
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->createAuthCredentials());

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Accept: application/json'
        ]);
    }

    /**
     * Returns an error if there is one otherwise empty string
     *
     * @throws FlexiBeeConnectionException
     */
    private function verifySuccess()
    {
        if (empty($this->curl))
        {
            throw new FlexiBeeConnectionException('curl not initialized');
        }
        else
        {
            $errNo = curl_errno($this->curl);

            if ($errNo !== 0)
            {
                $errString = (string)curl_error($this->curl);
                throw new FlexiBeeConnectionException($errString, $errNo);
            }
        }
    }

    /**
     * Sends the request to FlexiBee API
     * Returns \stdClass with the result data
     *
     * @return \stdClass
     * @throws FlexiBeeConnectionException
     */
    public function sendRequest()
    {
        if (empty($this->request))
        {
            throw new FlexiBeeConnectionException('Request has not been set.');
        }

        $this->hasError = FALSE;
        $this->error = NULL;

        if ($this->request instanceof BaseGetDataRequest)
        {
            /** @var BaseGetDataRequest $request */
            $request = $this->request;

            $url = $this->getBaseUrl() . $request->getRegister();

            if (!empty($request->getCustomUrl()))
            {
                $url .= '/' . $request->getCustomUrl();
            }
            elseif (!empty($request->getUrlFilter()))
            {
                $url .= '/' . $request->getUrlFilter();
            }

            if (!empty($request->getOrder()) && !empty($request->getLimit()))
            {
                $url .= '?' . $request->getOrder() . '&' . $request->getLimit();
            }
            elseif (!empty($request->getOrder()))
            {
                $url .= '?' . $request->getOrder();
            }
            elseif (!empty($request->getLimit()))
            {
                $url .= '?' . $request->getLimit();
            }

            if ($request->isSummedResult())
            {
                $url .= '/$sum';
            }
        }
        elseif ($this->request instanceof BaseSendDataRequest)
        {
            /** @var BaseSendDataRequest $request */
            $request = $this->request;

            $url = $this->getBaseUrl() . $request->getRegister() . '.json';

            curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');

            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $request->getRawData());
        }
        else
        {
            $this->hasError = TRUE;
            $this->error = 'Invalid request';
        }

        if (!$this->hasError && isset($url))
        {
            curl_setopt($this->curl, CURLOPT_URL, self::replaceUrlSpaces($url));

            $result = curl_exec($this->curl);

            $this->verifySuccess();

            $response = json_decode($result);

            $this->stdClassResponse = $response;

            $this->setUpError();

            return FlexiBeeParser::parse($this->stdClassResponse, $this->request);
        }

        return null;
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

        $parsedError = ErrorParser::parseFlexiBee($this->stdClassResponse);

        if ($parsedError !== NULL)
        {
            $this->hasError = TRUE;
            $this->error = $parsedError;
        }
    }

    /**
     * @param BaseRequest $request
     *
     * @return FlexiBeeConnector
     */
    public function setCustomRequest(BaseRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return IssuedInvoiceRequest
     */
    public function getIssuedInvoices()
    {
        $this->request = new IssuedInvoiceRequest();

        return $this->request;
    }

    /**
     * @return PriceListRequest
     */
    public function getPriceList()
    {
        $this->request = new PriceListRequest();

        return $this->request;
    }

    /**
     * @return ReceivedInvoiceRequest
     */
    public function getReceivedInvoices()
    {
        $this->request = new ReceivedInvoiceRequest();

        return $this->request;
    }

    /**
     * @return SendPriceItemRequest
     */
    public function sendPriceListItem()
    {
        $this->request = new SendPriceItemRequest();

        return $this->request;
    }

    /**
     * @return SendIssuedInvoiceRequest
     */
    public function sendIssuedInvoiceRequest()
    {
        $this->request = new SendIssuedInvoiceRequest();

        return $this->request;
    }
}