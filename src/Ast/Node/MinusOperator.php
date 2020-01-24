<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class MinusOperator.
 */
class MinusOperator extends AbstractOperator
{
    public function getPriority(): int
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array &$stack)
    {
        $op2 = array_pop($stack);
        $op1 = array_pop($stack);

        if (null === $op1) {
            $op1 = new Number(0);
        }

        if (null === $op2) {
            throw new \RuntimeException('Operator requires two nodes');
        }

        $result = $op1->getValue() - $op2->getValue();

        return new Number($result);
    }
}
