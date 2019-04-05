<?php

namespace AccSync\Pohoda\Data;

/**
 * Class XMLParser
 *
 * @package AccSync\Pohoda\Data
 * @author  miroslav.soukup2@gmail.com
 */
class XMLParser
{
    /**
     * Saves result into object
     * 
     * @param string $xmlString
     *
     * @return \stdClass
     */
    public static function parseXML($xmlString)
    {
        $result = NULL;

        $xml = simplexml_load_string($xmlString);

        $namespaces = $xml->getNamespaces(TRUE);

        $xml = NULL;

        $rmNamespaces = [];
        $replace = [];

        foreach ($namespaces as $namespace => $url)
        {
            $rmNamespaces[] = $namespace . ':';
            $replace[] = '';
        }

        $newString = str_replace($rmNamespaces, $replace, $xmlString);

        $xml = simplexml_load_string($newString);

        $json = json_encode($xml);

        $result = json_decode($json);

        return $result;
    }
}