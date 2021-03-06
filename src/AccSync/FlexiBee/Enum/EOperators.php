<?php

namespace AccSync\FlexiBee\Enum;

/**
 * Class EOperators
 * Operators which can be used to join conditions or in Condition class
 *
 * @package AccSync\FlexiBee\Enum
 * @author miroslav.soukup2@gmail.com
 */
class EOperators
{
    const EQUAL = '=';
    const NOT_EQUAL = '!=';
    const LESS = '<';
    const LESS_EQUAL = '<=';
    const GREATER = '>';
    const GREATER_EQUAL = '>';
    const LIKE = 'like';
    const LIKE_SIMILAR = 'like similar';
    const BETWEEN = 'between';
    const BEGINS = 'begins';
    const BEGINS_SIMILAR = 'begins similar';
    const ENDS = 'ends';
    const IN = 'in';
    const IN_SUBTREE = 'in subtree';
    const IS = 'is';
    const IS_NOT = 'is not';
    const IS_TRUE = 'is true';
    const IS_FALSE = 'is false';
    const IS_NULL = 'is null';
    const IS_NOT_NULL = 'is not null';
    const IS_EMPTY = 'is empty';
    const IS_NOT_EMPTY = 'is not empty';
    const LOGICAL_AND = 'and';
    const LOGICAL_OR = 'or';
    const LOGICAL_NOT = 'not';

    public static $ignoreExpressionValue = [
        self::IS_TRUE,
        self::IS_FALSE,
        self::IS_NULL,
        self::IS_NOT_NULL,
        self::IS_EMPTY,
        self::IS_NOT_EMPTY,
    ];
}