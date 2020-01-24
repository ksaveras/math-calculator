<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class AbstractOperator.
 */
abstract class AbstractOperator implements OperatorInterface
{
    public function isLowerPriority($node): bool
    {
        return ($node instanceof self) && ($this->getPriority() < $node->getPriority());
    }
}
