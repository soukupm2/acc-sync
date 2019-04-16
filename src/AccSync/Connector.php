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
     * @var $request
     */
    protected $request;
    /**
     * @var \stdClass $stdClassResponse
     */
    protected $stdClassResponse = NULL;
    /**
     * @var bool $hasError
     */
    protected $hasError = FALSE;
    /**
     * @var string $error
     */
    protected $error = NULL;

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

    /**
     * @return bool
     */
    public function hasError()
    {
        return $this->hasError;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return \stdClass
     */
    public function getStdClassResponse()
    {
        return $this->stdClassResponse;
    }

    /**
     * Function that sets up parameters $hasError and $error
     */
    abstract protected function setUpError();
}