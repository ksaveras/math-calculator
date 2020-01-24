<?php

namespace Ksaveras\MathCalculator\Test\Ast\Node;

use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use PHPUnit\Framework\TestCase;

class MinusOperatorTest extends TestCase
{
    /**
     * @dataProvider operatorDataProvider
     *
     * @param array $stack
     * @param mixed $expected
     */
    public function testExecute(array $stack, $expected): void
    {
        $operator = new MinusOperator();
        $result = $operator->execute($stack);

        $this->assertEquals($expected, $result->getValue());
    }

    /**
     * @dataProvider missingNodesDataProvider
     *
     * @param array $stack
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
    }

    public function missingNodesDataProvider(): \Generator
    {
        yield [[]];
        yield [[new Number(1)]];
    }
}
