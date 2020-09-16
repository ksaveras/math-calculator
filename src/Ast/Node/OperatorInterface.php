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

interface OperatorInterface extends NodeInterface
{
    public const LEFT_ASSOC = 1;
    public const RIGHT_ASSOC = 2;

    public function getPriority(): int;

    public function getAssociation(): int;

    public function execute(array &$stack): AbstractValue;
}
