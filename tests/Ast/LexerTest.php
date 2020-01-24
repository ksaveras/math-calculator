<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Test\Ast;

use Ksaveras\MathCalculator\Ast\Lexer;
use Ksaveras\MathCalculator\Ast\Node\DivisionOperator;
use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\PlusOperator;
use PHPUnit\Framework\TestCase;

class LexerTest extends TestCase
{
    /**
     * @dataProvider lexerDataProvider
     *
     * @param string $input
     * @param array  $expected
     */
    public function testParse(string $input, $expected): void
    {
        $lexer = new Lexer();
        $nodes = $lexer->parse($input);

        $this->assertEquals($expected, $nodes);
    }

    public function lexerDataProvider(): \Generator
    {
        yield ['1+2', [new Number(1), new PlusOperator(), new Number(2)]];
        yield ['2 - 1', [new Number(2), new MinusOperator(), new Number(1)]];
        yield ['2 - -1', [new Number(2), new MinusOperator(), new MinusOperator(), new Number(1)]];
        yield ['10 / 2', [new Number(10), new DivisionOperator(), new Number(2)]];
        yield ['2+10 / 2', [new Number(2), new PlusOperator(), new Number(10), new DivisionOperator(), new Number(2)]];
    }
}
