<?php

namespace AccSync\Pohoda\Data;

/**
 * Class ErrorParser
 *
 * @package AccSync\Pohoda\Data
 * @author  miroslav.soukup2@gmail.com
 */
class ErrorParser
{
    /**
     * If there is an error in the response, returns string describing it, otherwise returns null
     *
     * @param \stdClass $data
     * @return string|null
     */
    public static function parse(\stdClass $data)
    {
        if (isset($data->{'@attributes'}->state) && $data->{'@attributes'}->state == 'error')
        {
            return $data->{'@attributes'}->note;
        }
        elseif (isset($data->responsePackItem->{'@attributes'}->state) && $data->responsePackItem->{'@attributes'}->state == 'error')
        {
            return $data->responsePackItem->{'@attributes'}->note;
        }
        else
        {
            return NULL;
        }
    }
}