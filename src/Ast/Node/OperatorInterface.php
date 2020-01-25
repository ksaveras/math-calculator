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

    public function getPriority(): int;

    public function getAssociation(): int;

    public function execute(array &$stack): AbstractValue;
}
