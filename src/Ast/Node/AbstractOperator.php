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

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getAssociation(): int
    {
        return $this->association;
    }

    public function setAssociation(int $association): self
    {
        if (!\in_array($association, [static::LEFT_ASSOC, static::RIGHT_ASSOC], true)) {
            throw new \InvalidArgumentException('Invalid argument value for association');
        }

        $this->association = $association;

        return $this;
    }
}
