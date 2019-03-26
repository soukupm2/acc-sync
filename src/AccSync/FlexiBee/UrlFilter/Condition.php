<?php

namespace AccSync\FlexiBee\UrlFilter;

use AccSync\FlexiBee\Enum\EOperators;

/**
 * Class Condition
 *
 * @package AccSync\FlexiBee\UrlFilter
 * @author miroslav.soukup2@gmail.com
 */
class Condition
{
    /**
     * @var string $identifier
     */
    private $identifier;
    /**
     * @var string $operator
     */
    private $operator;
    /**
     * @var string $value
     */
    private $value;

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Return string representation of the string to be used in url
     *
     * @return string
     */
    public function getFullCondition()
    {
        $identifier = !empty($this->identifier) ? $this->identifier : NULL;
        $operator = !empty($this->operator) ? $this->operator : NULL;
        $value = !empty($this->value) ? $this->value : NULL;

        if (in_array($operator, EOperators::$ignoreExpressionValue))
        {
            $value = NULL;
        }

        return '(' . $identifier . ' ' . $operator . ' ' . $value . ')';
    }
}