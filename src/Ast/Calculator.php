<?php declare(strict_types=1);
/*
 * This file is part of ksaveras/math-calculator
 *
 * (c) Ksaveras Sakys <xawiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ksaveras\MathCalculator\Ast;

use Ksaveras\MathCalculator\Ast\Node\NodeInterface;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\OperatorInterface;

class Calculator
{
    /**
     * @param array<NodeInterface> $rpnNodes
     *
     * @return mixed
     */
    public function calculate(array $rpnNodes)
    {
        if (0 === \count($rpnNodes)) {
            throw new \InvalidArgumentException('Got empty list of RPN nodes');
        }

        $stack = [];
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
