<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast;

use Ksaveras\MathCalculator\Ast\Node\BitwiseAndOperator;
use Ksaveras\MathCalculator\Ast\Node\BitwiseOrOperator;
use Ksaveras\MathCalculator\Ast\Node\DivisionOperator;
use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\MultiplyOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\PlusOperator;

/**
 * Class NodeFactory.
 */
class NodeFactory
{
    public function createNode($token)
    {
        if (is_numeric($token)) {
            settype($token, gettype($token));
            return new Number($token);
        }

        if ('+' === $token) {
            return new PlusOperator();
        }
        if ('-' === $token) {
            return new MinusOperator();
        }
        if ('*' === $token) {
            return new MultiplyOperator();
        }
        if ('/' === $token) {
            return new DivisionOperator();
        }
        if ('|' === $token) {
            return new BitwiseOrOperator();
        }
        if ('&' === $token) {
            return new BitwiseAndOperator();
        }

        throw new \LogicException('Unsupported token '.$token);
    }
}
