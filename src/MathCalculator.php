<?php declare(strict_types=1);
/*
 * This file is part of ksaveras/math-calculator
 *
 * (c) Ksaveras Sakys <xawiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ksaveras\MathCalculator;

use Ksaveras\MathCalculator\Ast\Calculator;
use Ksaveras\MathCalculator\Ast\Lexer;

class MathCalculator
{
    /**
     * @var Lexer
     */
    private $lexer;

    /**
     * @var Calculator
     */
    private $calculator;

    public function __construct()
    {
        $this->lexer = new Lexer();
        $this->calculator = new Calculator();
    }

    /**
     * @return mixed
     */
    public function calculate(string $expression)
    {
        $nodeStream = $this->lexer->parse($expression);
        $rpnNodes = $this->lexer->buildReversePolishNotation($nodeStream);

        return $this->calculator->calculate($rpnNodes);
    }
}
