<?php

namespace AccSync\FlexiBee;

use AccSync\Connector;
use AccSync\Data\ErrorParser;
use AccSync\FlexiBee\Exception\FlexiBeeConnectionException;
use AccSync\FlexiBee\Requests\BaseRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\IssuedInvoiceRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\PriceListRequest;
use AccSync\FlexiBee\Requests\GetDataRequest\ReceivedInvoiceRequest;

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

        $url = $this->getBaseUrl() . $this->request->getRegister();

        if (!empty($this->request->getCustomUrl()))
        {
            $url .= '/' . $this->request->getCustomUrl();
        }
        elseif (!empty($this->request->getUrlFilter()))
        {
            $url .= '/' . $this->request->getUrlFilter();
        }

        if ($this->request->isSummedResult())
        {
            $url .= '/$sum';
        }

        curl_setopt($this->curl, CURLOPT_URL, self::replaceUrlSpaces($url));

        $result = curl_exec($this->curl);

        $this->verifySuccess();

        $this->stdClassResponse = json_decode($result);

        $this->setUpError();

        return $this->stdClassResponse;
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
}