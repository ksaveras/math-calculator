<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Test\Ast\Node;

use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use PHPUnit\Framework\TestCase;

class MinusOperatorTest extends TestCase
{
    /**
     * @dataProvider operatorDataProvider
     *
     * @param mixed $expected
     */
    public function testExecute(array $stack, $expected): void
    {
        $operator = new MinusOperator();
        $result = $operator->execute($stack);

        $this->assertEquals($expected, $result->getValue());
    }

    public function testStackSize(): void
    {
        $stack = [
            new Number(1),
            new Number(2),
            new Number(3),
        ];

        $operator = new MinusOperator();
        $result = $operator->execute($stack);

        $this->assertEquals(-1, $result->getValue());

        $this->assertCount(1, $stack);
    }

    /**
     * @dataProvider missingNodesDataProvider
     */
    public function testMissingNodes(array $stack): void
    {
        $this->expectException(\RuntimeException::class);

        (new MinusOperator())->execute($stack);
    }

    public function operatorDataProvider(): \Generator
    {
        yield [[new Number(1), new Number(2)], -1];
        yield [[new Number(5), new Number(2)], 3];
        yield [[new Number(-5), new Number(2)], -7];
        yield [[new Number(0), new Number(2)], -2];
        yield [[new Number(5), new Number(0)], 5];
        yield [[new Number(3.6), new Number(2.3)], 1.3];
        yield [[new Number(10)], -10];
    }

    public function missingNodesDataProvider(): \Generator
    {
        yield [[]];
    }
}
