<?php

namespace AccSync\Pohoda;

use AccSync\Pohoda\GetDataRequest\BaseGetDataRequest;

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
        set_time_limit(600);

        $curl = curl_init();
        $xmldata = $request->getXmlRequestString();

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'STW-Authorization: ' . $this->createAuthToken(),
            'Content-Type: text/xml',
            'Content-Length: '.strlen($xmldata)
        ]);

        curl_setopt($curl, CURLOPT_USERAGENT, self::USERAGENT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_TIMEOUT, 300);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($curl, CURLOPT_URL, $this->createUrl());
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xmldata);

        return curl_exec($curl);
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