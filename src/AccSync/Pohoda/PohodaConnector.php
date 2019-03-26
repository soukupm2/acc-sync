<?php

namespace AccSync\Pohoda;

use AccSync\Connector;
use AccSync\Pohoda\Data\XMLParser;
use AccSync\Pohoda\Enum\EResponseErrorCodes;
use AccSync\Pohoda\Exception\PohodaConnectionException;

/**
 * Class PohodaConnector
 *
 * @package AccSync\Pohoda
 * @author miroslav.soukup2@gmail.com
 */
class PohodaConnector extends Connector
{
    const USER_AGENT = 'test';
    /**
     * @var \DOMDocument $domResponse
     */
    private $domResponse = NULL;

    /**
     * PohodaConnector constructor.
     *
     * @param string $baseUri URI - expected format http://localhost
     * @param string|null $port Port number for communication
     * @param string $username User login name
     * @param string $password User login password
     */
    public function __construct($baseUri, $username, $password, $port = NULL)
    {
        $this->baseUri = $baseUri;
        $this->username = $username;
        $this->password = $password;
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
            'Content-Length: '.strlen($xml)
        ]);

        return curl_exec($this->curl);
    }

    /**
     * @inheritdoc
     */
    protected function curlInit()
    {
        parent::curlInit();

        curl_setopt($this->curl, CURLOPT_USERAGENT, self::USER_AGENT);
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
    private function getError()
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
     * @param BaseRequest $request
     *
     * @return \stdClass
     * @throws PohodaConnectionException
     */
    public function sendRequest(BaseRequest $request)
    {
        $response = $this->getCurlResponse($request);

        $this->getError();

        $dom = new \DOMDocument();
        $dom->loadXML($response,LIBXML_PARSEHUGE);
        $this->domResponse = $dom;

        $result = XMLParser::parseXML($dom->saveXML());

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
}