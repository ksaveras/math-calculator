<?php

namespace Ksaveras\MathCalculator\Ast;

use Ksaveras\MathCalculator\Ast\Node\MinusOperator;
use Ksaveras\MathCalculator\Ast\Node\NodeInterface;
use Ksaveras\MathCalculator\Ast\Node\Number;
use Ksaveras\MathCalculator\Ast\Node\OperatorInterface;

/**
 * Class Lexer.
 */
class Lexer
{
    /**
     * @return NodeInterface[]|array
     */
    public function parse(string $input): array
    {
        $tokens = token_get_all('<?php '.$input);
        array_shift($tokens);

        $nodeFactory = new NodeFactory();

        $nodeStream = [];
        foreach ($tokens as $token) {
            if (\is_string($token)) {
                $value = $token;
            } elseif (isset($token[0], $token[1]) && T_WHITESPACE !== $token[0]) {
                $value = $token[1];
            } else {
                $value = null;
            }

            if (null !== $value) {
                $nodeStream[] = $nodeFactory->createNode($value);
            }
        }

        return $nodeStream;
    }

    public function buildReversePolishNotation(array $nodeStream): array
    {
        $output = [];
        $stack = [];
        $lastNode = null;

        foreach ($nodeStream as $node) {
            switch (true) {
                case $node instanceof Number:
                    $output[] = $node;
                    break;
                case $node instanceof OperatorInterface:
                    if ($lastNode instanceof OperatorInterface && $node instanceof MinusOperator) {
                        $output[] = new Number(0);
                        $node->setAssociation(OperatorInterface::RIGHT_ASSOC);
                        $node->setPriority(100);
                    }

                    while (
                        ($count = \count($stack)) > 0
                        && ($stack[$count - 1] instanceof OperatorInterface
                            && (
                                (OperatorInterface::LEFT_ASSOC === $stack[$count - 1]->getAssociation()
                                    && $stack[$count - 1]->getPriority() === $node->getPriority())
                                || ($stack[$count - 1]->getPriority() > $node->getPriority())
                            )
                        )
                    ) {
                        $output[] = array_pop($stack);
                    }

                    $stack[] = $node;
                    break;
            }

            $lastNode = $node;
        }

        while (!empty($stack)) {
            $node = array_pop($stack);
            $output[] = $node;
        }

        return $output;
    }
}
