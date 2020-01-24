<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class DivisionOperator.
 */
class DivisionOperator implements OperatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(array &$stack)
    {
        $op2 = array_pop($stack);
        $op1 = array_pop($stack);

        if (null === $op1 || null === $op2) {
            throw new \RuntimeException('Operator requires two nodes');
        }

        if (0 == $op2->getValue()) {
            throw new \RuntimeException('Division by zero');
        }

        $result = $op1->getValue() / $op2->getValue();

        return new Number($result);
    }
}
