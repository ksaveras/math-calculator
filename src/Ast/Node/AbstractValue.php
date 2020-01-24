<?php

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class AbstractValue.
 */
abstract class AbstractValue
{
    private $value;

    /**
     * AbstractValue constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }
}
