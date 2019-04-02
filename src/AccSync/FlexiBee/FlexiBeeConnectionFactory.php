<?php

namespace AccSync\FlexiBee;

use AccSync\ConnectionFactory;

class FlexiBeeConnectionFactory extends ConnectionFactory
{
    /**
     * @return FlexiBeeConnector
     */
    public function create()
    {
        return new FlexiBeeConnector($this->baseUri, $this->username, $this->password, $this->companyId, $this->port);
    }
}