<?php

namespace AccSync\FlexiBee\Data;

use AccSync\FlexiBee\UrlFilter\Condition;

/**
 * Class FlexiBeeHelper
 *
 * @package AccSync\FlexiBee\Data
 * @author miroslav.soukup2@gmail.com
 */
class FlexiBeeHelper
{
    public static function joinConditions($operator, ...$conditions)
    {
        $result = '(';

        $iteration = 1;

        foreach ($conditions as $condition)
        {
            if ($condition instanceof Condition)
            {
                $result .= $condition->getFullExpression();
            }
            elseif (is_string($condition))
            {
                $result .= $condition;
            }
            else
            {
                continue;
            }

            if (count($condition) > $iteration)
            {
                $result .= ' ' . $operator . ' ';
            }

            $iteration ++;
        }

        $result .= ')';

        return $result;
    }
}