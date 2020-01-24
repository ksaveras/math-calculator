<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Test\Ast\Node;

use Ksaveras\MathCalculator\Ast\Node\BitwiseAndOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use PHPUnit\Framework\TestCase;

class BitwiseAndOperatorTest extends TestCase
{
    /**
     * @dataProvider operatorDataProvider
     *
     * @param array $stack
     * @param mixed $expected
     */
    public function testExecute(array $stack, $expected): void
    {
        $operator = new BitwiseAndOperator();
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

        $operator = new BitwiseAndOperator();
        $result = $operator->execute($stack);

        $this->assertEquals(2, $result->getValue());

        $this->assertCount(1, $stack);
    }

    /**
     * @dataProvider missingNodesDataProvider
     *
     * @param array $stack
     */
    public function testMissingNodes(array $stack): void
    {
        $this->expectException(\RuntimeException::class);

        (new BitwiseAndOperator())->execute($stack);
    }

    public function operatorDataProvider(): \Generator
    {
        yield [[new Number(1), new Number(3)], 1];
        yield [[new Number(4), new Number(6)], 4];
        yield [[new Number(10), new Number(22)], 2];
        yield [[new Number(0), new Number(2)], 0];
        yield [[new Number(5), new Number(0)], 0];
        yield [[new Number(2.5), new Number(3.6)], 2];
    }

    public function missingNodesDataProvider(): \Generator
    {
        yield [[]];
        yield [[new Number(1)]];
    }
}
