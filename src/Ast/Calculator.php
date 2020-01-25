<?php

namespace Ksaveras\MathCalculator\Ast;

use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\OperatorInterface;

/**
 * Class Calculator.
 */
class Calculator
{
    /**
     * @param array $rpnNodes
     *
     * @return mixed
     */
    public function calculate(array $rpnNodes)
    {
        $stack = array();
        foreach ($rpnNodes as $node) {
            if ($node instanceof Number) {
                $stack[] = $node;
            }
            if ($node instanceof OperatorInterface) {
                $stack[] = $node->execute($stack);
            }
        }

        $result = array_pop($stack);
        if (!empty($stack)) {
            throw new \RuntimeException('Incorrect expression');
        }

        return $result->getValue();
    }
}
