<?php

namespace AccSync;

/**
 * Class Connector
 *
 * @package AccSync
 * @author miroslav.soukup2@gmail.com
 */
abstract class Connector
{
    /**
     * @const string USER_AGENT
     */
    const USER_AGENT = 'test';
    /**
     * @var string $username 
     */
    protected $username;
    /**
     * @var string $password
     */
    protected $password;
    /**
     * @var string URI - expected format http://localhost
     */
    protected $baseUri;
    /**
     * @var string Number of port for communication
     */
    protected $port;
    /**
     * @var resource $curl
     */
    protected $curl;
    /**
     * @var string $companyId
     */
    protected $companyId;

    /**
     * Connector constructor.
     */
    public function __construct()
    {
        $this->curlInit();
    }

    /**
     * Creates string with username and password
     *
     * @return string
     */
    protected function createAuthCredentials()
    {
        return $this->username.':'.$this->password;
    }

    /**
     * Creates authorization token for HTTP communication
     *
     * @return string
     */
    protected function createAuthToken()
    {
        return 'Basic ' . base64_encode($this->createAuthCredentials());
    }

    /**
     * Curl init
     */
    protected function curlInit()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 300);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    }

    /**
     * Connector destructor.
     */
    public function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * Replaces spaces in URL
     *
     * @param string $url
     * @return string
     */
    protected static function replaceUrlSpaces($url)
    {
        $replacePairs = array(
            "\t" => '%20',
            " " => '%20',
        );

        return strtr($url, $replacePairs);
    }
}