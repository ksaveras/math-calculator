<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast;

use Ksaveras\MathCalculator\Ast\Node\BitwiseAndOperator;
use Ksaveras\MathCalculator\Ast\Node\BitwiseOrOperator;
use Ksaveras\MathCalculator\Ast\Node\DivisionOperator;
use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\MultiplyOperator;
use Ksaveras\MathCalculator\Ast\Node\NodeInterface;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\PlusOperator;

/**
 * Class NodeFactory.
 */
class NodeFactory
{
    /**
     * @param $token
     */
    public function createNode($token): NodeInterface
    {
        if (is_numeric($token)) {
            $token += 0;

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

        throw new \LogicException(sprintf('Unsupported token "%s"', $token));
    }
}
