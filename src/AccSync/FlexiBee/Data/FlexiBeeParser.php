<?php

namespace AccSync\FlexiBee\Data;

use AccSync\FlexiBee\Requests\BaseRequest;

class FlexiBeeParser
{
    const WINSTROM = 'winstrom';

    public static function parse(\stdClass $data, BaseRequest $request)
    {
        if (isset($data->{self::WINSTROM}))
        {
            $baseChild = $data->{self::WINSTROM};

            if (isset($baseChild->{$request->getRegister()}))
            {
                return $baseChild->{$request->getRegister()};
            }

            return $baseChild;
        }

        return $data;
    }
}