<?php

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class PlusOperator.
 */
class PlusOperator implements OperatorInterface
{
    /**
     * @param array $stack
     *
     * @return mixed
     */
    public function execute(array $stack)
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
