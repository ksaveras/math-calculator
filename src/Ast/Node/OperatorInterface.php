<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Interface OperatorInterface.
 */
interface OperatorInterface
{
    /**
     * @return int
     */
    public function getPriority(): int;

    /**
     * @param mixed $node
     *
     * @return bool
     */
    public function isLowerPriority($node): bool;

    /**
     * @param array $stack
     *
     * @return mixed
     */
    public function execute(array &$stack);
}
