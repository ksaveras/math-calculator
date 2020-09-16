<?php declare(strict_types=1);
/*
 * This file is part of ksaveras/math-calculator
 *
 * (c) Ksaveras Sakys <xawiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ksaveras\MathCalculator\Test\Ast;

use Ksaveras\MathCalculator\Ast\Lexer;
use Ksaveras\MathCalculator\Ast\Node\DivisionOperator;
use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\MultiplyOperator;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\OperatorInterface;
use Ksaveras\MathCalculator\Ast\Node\PlusOperator;
use PHPUnit\Framework\TestCase;

class LexerTest extends TestCase
{
    /**
     * @dataProvider lexerDataProvider
     *
     * @param array $expected
     */
    public function testParse(string $input, $expected): void
    {
        $lexer = new Lexer();
        $nodes = $lexer->parse($input);

        self::assertEquals($expected, $nodes);
    }

    public function lexerDataProvider(): \Generator
    {
        yield ['1+2', [new Number(1), new PlusOperator(), new Number(2)]];
        yield ['2 - 1', [new Number(2), new MinusOperator(), new Number(1)]];
        yield [
            '-2 - -1',
            [new MinusOperator(), new Number(2), new MinusOperator(), new MinusOperator(), new Number(1)],
        ];
        yield ['10 / 2', [new Number(10), new DivisionOperator(), new Number(2)]];
        yield ['2+10 / 2', [new Number(2), new PlusOperator(), new Number(10), new DivisionOperator(), new Number(2)]];
        yield [
            '10*2*2',
            [new Number(10), new MultiplyOperator(), new Number(2), new MultiplyOperator(), new Number(2)],
        ];
    }

    /**
     * @dataProvider nodeStreamDataProvider
     */
    public function testReversePolishNotation(array $nodeStream, array $expected): void
    {
        $lexer = new Lexer();
        $nodes = $lexer->buildReversePolishNotation($nodeStream);

        self::assertEquals($expected, $nodes);
    }

    public function nodeStreamDataProvider(): \Generator
    {
        yield [
            [
                new Number(5),
                new PlusOperator(),
                new Number(6),
                new MultiplyOperator(),
                new Number(3),
            ],
            [
                new Number(5),
                new Number(6),
                new Number(3),
                new MultiplyOperator(),
                new PlusOperator(),
            ],
        ];

        yield [
            [
                new Number(5),
                new PlusOperator(),
                new MinusOperator(),
                new Number(6),
            ],
            [
                new Number(5),
                new Number(0),
                new Number(6),
                (new MinusOperator())->setPriority(100)->setAssociation(OperatorInterface::RIGHT_ASSOC),
                new PlusOperator(),
            ],
        ];

        yield [
            [
                new MinusOperator(),
                new Number(5),
                new PlusOperator(),
                new Number(6),
            ],
            [
                new Number(5),
                new MinusOperator(),
                new Number(6),
                new PlusOperator(),
            ],
        ];

        yield [
            [
                new Number(5),
                new PlusOperator(),
                new Number(6),
                new MultiplyOperator(),
                new Number(10),
                new DivisionOperator(),
                new Number(1),
                new MinusOperator(),
                new Number(10),
            ],
            [
                new Number(5),
                new Number(6),
                new Number(10),
                new MultiplyOperator(),
                new Number(1),
                new DivisionOperator(),
                new PlusOperator(),
                new Number(10),
                new MinusOperator(),
            ],
        ];
    }
}
