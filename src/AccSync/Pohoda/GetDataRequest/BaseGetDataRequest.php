<?php

namespace AccSync\Pohoda\GetDataRequest;


abstract class BaseGetDataRequest
{
    /**
     * @var string $requestId Request ID, it is in the response for identification
     */
    protected $requestId;
    /**
     * @var string $in Identification number of company, must be in every request
     */
    protected $in;

    /**
     * BaseGetDataRequest constructor.
     *
     * @param string $requestId Request ID, it is in the response for identification
     * @param string $in        Identification number of company, must be in every request
     */
    public function __construct($requestId, $in)
    {
        $this->requestId = $requestId;
        $this->in = $in;
    }

    /**
     * Returns name of the class
     * Used in note for requests
     *
     * @return string
     */
    protected function getNote()
    {
        return get_class($this);
    }

    /**
     * Returns identification number
     *
     * @return string
     */
    public function getIn()
    {
        return $this->in;
    }

    /**
     * Returns ID of request
     *
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Returns string with XML specified for request purposes
     *
     * @return string
     */
    public abstract function getXmlRequestString();
}