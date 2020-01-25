<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Interface OperatorInterface.
 */
interface OperatorInterface extends NodeInterface
{
    public const LEFT_ASSOC = 1;
    public const RIGHT_ASSOC = 2;

    /**
     * @return int
     */
    public function getPriority(): int;

    /**
     * @return int
     */
    public function getAssociation(): int;

    /**
     * @param array $stack
     *
     * @return AbstractValue
     */
    public function execute(array &$stack): AbstractValue;
}
