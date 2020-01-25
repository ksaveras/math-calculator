<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class PlusOperator.
 */
final class PlusOperator extends AbstractOperator
{
    /**
     * PlusOperator constructor.
     */
    public function __construct()
    {
        $this->priority = 3;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array &$stack): AbstractValue
    {
        $op2 = array_pop($stack);
        $op1 = array_pop($stack);

        if (null === $op1 || null === $op2) {
            throw new \RuntimeException('Operator requires two nodes');
        }

        $result = $op1->getValue() + $op2->getValue();

        return new Number($result);
    }
}
