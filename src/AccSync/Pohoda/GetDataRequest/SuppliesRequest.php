<?php

namespace AccSync\Pohoda\GetDataRequest;


class SuppliesRequest extends BaseGetDataRequest
{
    /**
     * @inheritdoc
     */
    public function getXmlRequestString()
    {
        $request = '
            <?xml version="1.0" encoding="Windows-1250"?>
            <dat:dataPack xmlns:dat="http://www.stormware.cz/schema/version_2/data.xsd"
                          xmlns:stk="http://www.stormware.cz/schema/version_2/stock.xsd"
                          xmlns:ftr="http://www.stormware.cz/schema/version_2/filter.xsd"
                          xmlns:lStk="http://www.stormware.cz/schema/version_2/list_stock.xsd"
                          xmlns:typ="http://www.stormware.cz/schema/version_2/type.xsd" id="' . $this->requestId . '"
                          ico="' . $this->in . '" application="HTTP klient" version="2.0" note="' .$this->getNote() . '">
            <dat:dataPackItem id="' . $this->requestId . '" version="2.0">
                <lStk:listStockRequest version="2.0" stockVersion="2.0">
                  <lStk:requestStock/> 
                </lStk:listStockRequest> 
              </dat:dataPackItem> 
            </dat:dataPack>';

        return $request;
    }
}