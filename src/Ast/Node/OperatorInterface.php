<?php

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Interface OperatorInterface.
 */
interface OperatorInterface
{
    public function execute(array $stack);
}
