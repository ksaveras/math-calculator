<?php

namespace Ksaveras\MathCalculator;

use Ksaveras\MathCalculator\Ast\Calculator;
use Ksaveras\MathCalculator\Ast\Lexer;

/**
 * Class MathCalculator.
 */
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

    /**
     * MathCalculator constructor.
     */
    public function __construct()
    {
        $this->lexer = new Lexer();
        $this->calculator = new Calculator();
    }

    /**
     * @param string $expression
     *
     * @return mixed
     */
    public function calculate(string $expression)
    {
        $nodeStream = $this->lexer->parse($expression);
        $rpnNodes = $this->lexer->buildReversePolishNotation($nodeStream);

        return $this->calculator->calculate($rpnNodes);
    }
}
