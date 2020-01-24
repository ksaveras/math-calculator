<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class PlusOperator.
 */
class PlusOperator implements OperatorInterface
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

        $result = $op1->getValue() + $op2->getValue();

        return new Number($result);
    }
}
