<?php

namespace AccSync\FlexiBee\Data;

use AccSync\FlexiBee\UrlFilter\FlexiBeeCondition;

/**
 * Class FlexiBeeHelper
 *
 * @package AccSync\FlexiBee\Data
 * @author miroslav.soukup2@gmail.com
 */
class FlexiBeeHelper
{
    /**
     * Joins the conditions together
     * Number of conditions is unlimited and is joined by the same operator
     * Joining with different operators can be done by using this function multiple times
     *
     * @param string                   $operator
     * @param string|FlexiBeeCondition ...$conditions
     * @return string
     */
    public static function joinConditions($operator, ...$conditions)
    {
        if (empty($conditions))
        {
            return NULL;
        }

        $result = '(';

        $iteration = 1;
        $itemsCount = count($conditions);

        foreach ($conditions as $condition)
        {
            if ($condition instanceof FlexiBeeCondition)
            {
                $result .= $condition->getFullCondition();
            }
            elseif (is_string($condition))
            {
                $result .= $condition;
            }
            else
            {
                continue;
            }

            if ($itemsCount > $iteration)
            {
                $result .= ' ' . $operator . ' ';
            }

            $iteration ++;
        }

        $result .= ')';

        return $result;
    }
}