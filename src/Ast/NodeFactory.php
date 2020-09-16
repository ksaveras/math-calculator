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

use Ksaveras\MathCalculator\Ast\Node\AbstractOperator;
use Ksaveras\MathCalculator\Ast\Node\BitwiseAndOperator;
use Ksaveras\MathCalculator\Ast\Node\BitwiseOrOperator;
use Ksaveras\MathCalculator\Ast\Node\DivisionOperator;
use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\MultiplyOperator;
use Ksaveras\MathCalculator\Ast\Node\NodeInterface;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\PlusOperator;

class NodeFactory
{
    /**
     * @var array<int, AbstractOperator>|AbstractOperator[]
     */
    private static $operatorObjects = [];

    /**
     * @var string[]|array<string, string>
     */
    private static $operatorMap = [
        '+' => PlusOperator::class,
        '-' => MinusOperator::class,
        '*' => MultiplyOperator::class,
        '/' => DivisionOperator::class,
        '|' => BitwiseOrOperator::class,
        '&' => BitwiseAndOperator::class,
    ];

    public function createNode(string $token): NodeInterface
    {
        if (is_numeric($token)) {
            $token += 0;

            return new Number($token);
        }

        if (!isset(self::$operatorObjects[$token])) {
            if (!isset(static::$operatorMap[$token])) {
                throw new \LogicException(sprintf('Unsupported token "%s"', $token));
            }
            self::$operatorObjects[$token] = new self::$operatorMap[$token]();
        }

        return self::$operatorObjects[$token];
    }
}
