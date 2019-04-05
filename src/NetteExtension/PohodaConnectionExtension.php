<?php

namespace AccSync\NetteExtension;

use AccSync\Pohoda\PohodaConnectionFactory;

class PohodaConnectionExtension extends \Nette\DI\CompilerExtension
{
    const BASE_URI = 'base_uri';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const COMPANY_ID = 'company_id';
    const PORT = 'port';

    const REQUIRED_PARAMS = [
        self::BASE_URI,
        self::USERNAME,
        self::PASSWORD,
        self::COMPANY_ID,
    ];

    /**
     * @var string $baseUri
     */
    private $baseUri;
    /**
     * @var string $username
     */
    private $username;
    /**
     * @var string $password
     */
    private $password;
    /**
     * @var string $companyId
     */
    private $companyId;
    /**
     * @var int $port
     */
    private $port;

    /**
     * Loads configuration from config file
     *
     * @throws \Nette\Neon\Exception
     */
    public function loadConfiguration()
    {
        $this->setUpParams();

        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('articles'))
            ->setFactory(PohodaConnectionFactory::class)
            ->setArguments([$this->baseUri, $this->username, $this->password, $this->companyId, $this->port]);
    }

    /**
     * Sets up the parameters from configuration file
     *
     * @throws \Nette\Neon\Exception
     */
    private function setUpParams()
    {
        $configParams = $this->getConfig();

        foreach (self::REQUIRED_PARAMS as $required)
        {
            if (!isset($configParams[$required]))
            {
                throw new \Nette\Neon\Exception('Missing parameter ' . $required . ' in configuration file!');
            }
        }

        $this->baseUri = $configParams[self::BASE_URI];
        $this->username = $configParams[self::USERNAME];
        $this->password = $configParams[self::PASSWORD];
        $this->companyId = $configParams[self::COMPANY_ID];
        $this->port = $configParams[self::PORT];
    }
}