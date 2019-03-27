<?php

namespace AccSync;

use AccSync\FlexiBee\FlexiBeeConnector;
use AccSync\Pohoda\PohodaConnector;

/**
 * Class ConnectionFactory
 *
 * @package AccSync
 * @author  miroslav.soukup2@gmail.com
 */
class ConnectionFactory
{
    const FLEXI_BEE_CONNECTOR = 'flexibee';
    const POHODA_CONNECTOR = 'pohoda';

    /**
     * Creates the connector to accounting system
     *
     * @param string      $connector Type of connector to be used
     * @param string      $baseUri   Uri where the server is running
     * @param string      $username  Name of the user to be connected
     * @param string      $password  Users password
     * @param string|null $companyId Identifier of the company
     * @param int|null    $port      Number of the portr
     *
     * @return FlexiBeeConnector|PohodaConnector
     */
    public static function create($connector, $baseUri, $username, $password, $companyId, $port = NULL)
    {
        if ($connector === self::FLEXI_BEE_CONNECTOR)
        {
            if (empty($companyId))
            {
                throw new \InvalidArgumentException('Company ID cannot be empty for FlexiBee Connector');
            }

            return new FlexiBeeConnector($baseUri, $username, $password, $companyId, $port);
        }
        elseif ($connector === self::POHODA_CONNECTOR)
        {
            return new PohodaConnector($baseUri, $username, $password, $companyId, $port);
        }
        else
        {
            throw new \InvalidArgumentException('Connector type is not valid');
        }
    }
}