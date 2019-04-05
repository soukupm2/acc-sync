<?php

namespace AccSync;

/**
 * Class ConnectionFactory
 *
 * @package AccSync
 * @author  miroslav.soukup2@gmail.com
 */
abstract class ConnectionFactory
{
    /**
     * @var string $baseUri
     */
    protected $baseUri;
    /**
     * @var string $username
     */
    protected $username;
    /**
     * @var string $password
     */
    protected $password;
    /**
     * @var string $companyId
     */
    protected $companyId;
    /**
     * @var int|null $port
     */
    protected $port;

    /**
     * Constructor.
     *
     * @param string   $baseUri
     * @param string   $username
     * @param string   $password
     * @param string   $companyId
     * @param int|null $port
     */
    public function __construct($baseUri, $username, $password, $companyId, $port = NULL)
    {
        if (empty($baseUri))
        {
            throw new \InvalidArgumentException('BaseUri cannot be empty');
        }
        if (empty($username))
        {
            throw new \InvalidArgumentException('Username cannot be empty');
        }
        if (empty($companyId))
        {
            throw new \InvalidArgumentException('Company ID cannot be empty');
        }

        $this->baseUri = $baseUri;
        $this->username = $username;
        $this->password = $password;
        $this->companyId = $companyId;
        $this->port = $port;
    }

    public abstract function create();
}