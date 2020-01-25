<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Ast\Node;

/**
 * Class AbstractOperator.
 */
abstract class AbstractOperator implements OperatorInterface
{
    /**
     * @var int
     */
    protected $priority = 1;

    /**
     * @var int
     */
    protected $association = self::LEFT_ASSOC;

    /**
     * {@inheritdoc}
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociation(): int
    {
        return $this->association;
    }

    /**
     * @param int $association
     */
    public function setAssociation(int $association): void
    {
        if (!in_array($association, [static::LEFT_ASSOC, static::RIGHT_ASSOC], true)) {
            throw new \InvalidArgumentException('Invalid argument value for association');
        }

        $this->association = $association;
    }
}
