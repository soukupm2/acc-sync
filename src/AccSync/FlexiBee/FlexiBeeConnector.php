<?php

namespace AccSync\FlexiBee;

use AccSync\Connector;
use AccSync\FlexiBee\GetDataRequest\BaseGetDataRequest;

/**
 * Class FlexiBeeConnector
 *
 * @package AccSync\FlexiBee
 * @author miroslav.soukup2@gmail.com
 */
class FlexiBeeConnector extends Connector
{
    /**
     * @var string $companyId
     */
    private $companyId;

    /**
     * FlexiBeeConnector constructor.
     *
     * @param string $baseUri URI - expected format http://localhost
     * @param string $username User login name
     * @param string $password User login password
     * @param $companyId
     * @param string $port Number of port for communication
     */
    public function __construct($baseUri, $username, $password, $companyId, $port = NULL)
    {
        $this->baseUri = $baseUri;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->companyId = $companyId;

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
     * Sends the request to Pohoda API
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

        return curl_exec($this->curl);
    }

    /**
     * Replaces spaces in URL
     *
     * @param string $url
     * @return string
     */
    private static function replaceUrlSpaces($url)
    {
        $replacePairs = array(
            "\t" => '%20',
            " " => '%20',
        );

        return strtr($url, $replacePairs);
    }
}