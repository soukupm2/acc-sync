<?php

namespace AccSync\Pohoda;

use AccSync\Pohoda\GetDataRequest\BaseGetDataRequest;

/**
 * Class PohodaConnector
 * @package AccSync\Pohoda
 * @author miroslav.soukup2@gmail.com
 */
class PohodaConnector
{
    const USER_AGENT = 'test';
    /**
     * @var string URI - expected format http://localhost
     */
    private $baseUri;
    /**
     * @var string Number of port for communication
     */
    private $port;
    /**
     * @var string User login name
     */
    private $username;
    /**
     * @var string User login password
     */
    private $password;
    /**
     * @var resource $curl
     */
    private $curl;

    /**
     * PohodaConnector constructor.
     *
     * @param string $baseUri URI - expected format http://localhost
     * @param string $port Number of port for communication
     * @param string $username User login name
     * @param string $password User login password
     */
    public function __construct($baseUri, $port, $username, $password)
    {
        $this->baseUri = $baseUri;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Creates full URL for request
     *
     * @return string
     */
    private function createUrl()
    {
        return $this->baseUri . ':' . $this->port . '/xml';
    }

    /**
     * Creates authorization token for XML
     *
     * @return string
     */
    private function createAuthToken()
    {
        return 'Basic ' . base64_encode($this->username.':'.$this->password);
    }

    /**
     * Sends 
     *
     * @param BaseGetDataRequest $request
     *
     * @return bool|string
     */
    private function getCurlResponse(BaseGetDataRequest $request)
    {
        $this->curl = curl_init();
        $xml = $request->getXmlRequestString();

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'STW-Authorization: ' . $this->createAuthToken(),
            'Content-Type: text/xml',
            'Content-Length: '.strlen($xml)
        ]);

        curl_setopt($this->curl, CURLOPT_USERAGENT, self::USER_AGENT);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 300);
        curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($this->curl, CURLOPT_URL, $this->createUrl());
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->curl, CURLOPT_POST, TRUE);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $xml);

        return curl_exec($this->curl);
    }

    /**
     * Returns an error if there is one otherwise empty string
     *
     * @return string
     */
    public function getError()
    {
        if (empty($this->curl))
        {
            throw new \BadMethodCallException('curl not initialized');
        }
        else
        {
            return (string)curl_error($this->curl);
        }
    }

    /**
     * Sends the request to Pohoda API
     *
     * @param BaseGetDataRequest $request
     *
     * @return \DOMDocument
     */
    public function sendRequest(BaseGetDataRequest $request)
    {
        $response = $this->getCurlResponse($request);

        $dom = new \DOMDocument();
        $dom->loadXML($response,LIBXML_PARSEHUGE);
        return $dom;
    }
}