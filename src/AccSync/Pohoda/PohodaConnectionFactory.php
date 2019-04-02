<?php

namespace AccSync\Pohoda;

use AccSync\ConnectionFactory;

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