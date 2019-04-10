<?php

namespace AccSync\FlexiBee;

use AccSync\Connector;
use AccSync\FlexiBee\Requests\GetDataRequest\BaseGetDataRequest;

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
     * Sends the request to FlexiBee API
     * Returns \stdClass with the result data
     *
     * @param BaseGetDataRequest $request
     * @return \stdClass
     */
    public function sendRequest(BaseGetDataRequest $request)
    {
        $url = $this->getBaseUrl() . $request->getRegister();

        if (!empty($request->getCustomUrl()))
        {
            $url .= '/' . $request->getCustomUrl();
        }
        elseif (!empty($request->getUrlFilter()))
        {
            $url .= '/' . $request->getUrlFilter();
        }

        if ($request->isSummedResult())
        {
            $url .= '/$sum';
        }

        curl_setopt($this->curl, CURLOPT_URL, self::replaceUrlSpaces($url));

        $result = curl_exec($this->curl);

        return $result;
    }
}