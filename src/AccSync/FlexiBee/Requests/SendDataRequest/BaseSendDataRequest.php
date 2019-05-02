<?php

namespace AccSync\FlexiBee\Requests\SendDataRequest;

use AccSync\FlexiBee\Requests\BaseRequest;

abstract class BaseSendDataRequest extends BaseRequest
{
    /**
     * @var array $rawData
     */
    protected $rawData;
    /**
     * @var array $additionalData
     */
    protected $additionalData;
    /**
     * @var string $rootKey
     */
    protected $rootKey = 'winstrom';
    /**
     * @var array $aliases
     */
    protected $aliases;
    /**
     * @var array $ignoredProperties
     */
    protected $ignoredProperties = [
        'ignoredProperties',
        'register',
        'additionalData',
        'rootKey',
        'aliases',
        'rawData',
    ];

    /**
     * @return string
     */
    public function getRawData()
    {
        $this->mapOptions();

        return json_encode($this->rawData);
    }

    /**
     * Adds post value into the array
     *
     * @param string $key
     * @param string $value
     */
    public function setCustomProperty($key, $value)
    {
        $this->additionalData[$this->rootKey][$this->getRegister()][$key] = $value;

        return $this;
    }

    /**
     * Maps defined options together with additional data
     */
    protected abstract function mapOptions();
}