<?php

namespace AccSync\Data;

/**
 * Class ErrorParser
 *
 * @package AccSync\Data
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
    public static function parsePohoda(\stdClass $data)
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

    /**
     * If there is an error in the response, returns string describing it, otherwise returns null
     *
     * @param \stdClass $data
     * @return string|null
     */
    public static function parseFlexiBee(\stdClass $data)
    {
        if (isset($data->winstrom->success) && $data->winstrom->success == 'false')
        {
            if (isset($data->winstrom->message))
            {
                return $data->winstrom->message;
            }

            return 'Unknown error';
        }
        else
        {
            return NULL;
        }
    }
}