<?php

namespace AccSync\Pohoda;

use AccSync\ConnectionFactory;

/**
 * Class PohodaConnectionFactory
 *
 * @package AccSync\Pohoda
 * @author  miroslav.soukup2@gmail.com
 */
class PohodaConnectionFactory extends ConnectionFactory
{
    /**
     * @return PohodaConnector
     */
    public function create()
    {
        return new PohodaConnector($this->baseUri, $this->username, $this->password, $this->companyId, $this->port);
    }
}