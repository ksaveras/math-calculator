<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Test\Ast\Node;

use Ksaveras\MathCalculator\Ast\Node\DivisionOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use PHPUnit\Framework\TestCase;

class DivisionOperatorTest extends TestCase
{
    /**
     * @dataProvider operatorDataProvider
     *
     * @param array $stack
     * @param mixed $expected
     */
    public function testExecute(array $stack, $expected): void
    {
        $operator = new DivisionOperator();
        $result = $operator->execute($stack);

        $this->assertEquals($expected, $result->getValue());
    }

    public function testStackSize(): void
    {
        $stack = [
            new Number(1),
            new Number(4),
            new Number(2),
        ];

        $operator = new DivisionOperator();
        $result = $operator->execute($stack);

        $this->assertEquals(2, $result->getValue());

        $this->assertCount(1, $stack);
    }

    /**
     * @dataProvider divisionZeroDataProvider
     *
     * @param array $stack
     */
    public function testDivisionByZero(array $stack): void
    {
        $this->expectException(\RuntimeException::class);

        (new DivisionOperator())->execute($stack);
    }

    /**
     * @dataProvider missingNodesDataProvider
     *
     * @param array $stack
     */
    public function testMissingNodes(array $stack): void
    {
        $this->expectException(\RuntimeException::class);

        (new DivisionOperator())->execute($stack);
    }

    public function operatorDataProvider(): \Generator
    {
        yield [[new Number(1), new Number(2)], 0.5];
        yield [[new Number(6), new Number(2)], 3];
        yield [[new Number(-10), new Number(2)], -5];
        yield [[new Number(10), new Number(-2)], -5];
        yield [[new Number(0), new Number(2)], 0];
        yield [[new Number(3.6), new Number(1.2)], 3];
    }

    public function missingNodesDataProvider(): \Generator
    {
        yield [[]];
        yield [[new Number(1)]];
    }

    public function divisionZeroDataProvider(): \Generator
    {
        yield [[new Number(10), new Number(0)]];
        yield [[new Number(10), new Number(0.0)]];
        yield [[new Number(10), new Number(.0)]];
        yield [[new Number(10), new Number(-0)]];
        yield [[new Number(10), new Number(-0.0)]];
    }
}
