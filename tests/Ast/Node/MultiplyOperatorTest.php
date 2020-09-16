<?php declare(strict_types=1);
/*
 * This file is part of ksaveras/math-calculator
 *
 * (c) Ksaveras Sakys <xawiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ksaveras\MathCalculator\Test\Ast\Node;

use Ksaveras\MathCalculator\Ast\Node\MultiplyOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use PHPUnit\Framework\TestCase;

class MultiplyOperatorTest extends TestCase
{
    /**
     * @dataProvider operatorDataProvider
     *
     * @param mixed $expected
     */
    public function testExecute(array $stack, $expected): void
    {
        $operator = new MultiplyOperator();
        $result = $operator->execute($stack);

        self::assertEquals($expected, $result->getValue());
    }

    public function testStackSize(): void
    {
        $stack = [
            new Number(1),
            new Number(2),
            new Number(3),
        ];

        $operator = new MultiplyOperator();
        $result = $operator->execute($stack);

        self::assertEquals(6, $result->getValue());

        self::assertCount(1, $stack);
    }

    /**
     * @dataProvider missingNodesDataProvider
     */
    public function testMissingNodes(array $stack): void
    {
        $this->expectException(\RuntimeException::class);

        (new MultiplyOperator())->execute($stack);
    }

    public function operatorDataProvider(): \Generator
    {
        yield [[new Number(1), new Number(2)], 2];
        yield [[new Number(5), new Number(2)], 10];
        yield [[new Number(-5), new Number(2)], -10];
        yield [[new Number(0), new Number(2)], 0];
        yield [[new Number(5), new Number(0)], 0];
        yield [[new Number(3.6), new Number(2.3)], 8.28];
    }

    public function missingNodesDataProvider(): \Generator
    {
        yield [[]];
        yield [[new Number(1)]];
    }
}
