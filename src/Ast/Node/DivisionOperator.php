<?php declare(strict_types=1);
/*
 * This file is part of ksaveras/math-calculator
 *
 * (c) Ksaveras Sakys <xawiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ksaveras\MathCalculator\Ast\Node;

final class DivisionOperator extends AbstractOperator
{
    public function __construct()
    {
        $this->priority = 4;
    }

    public function execute(array &$stack): AbstractValue
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
