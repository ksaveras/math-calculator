<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Interface OperatorInterface.
 */
interface OperatorInterface
{
    /**
     * @param array $stack
     *
     * @return mixed
     */
    public function execute(array $stack);
}
