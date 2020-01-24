<?php

namespace Ksaveras\MathCalculator\Ast;

/**
 * Class Lexer.
 */
class Lexer
{
    public function parse(string $input): array
    {
        $tokens = token_get_all('<?php '.$input);
        array_shift($tokens);

        $nodeFactory = new NodeFactory();

        $nodeStream = [];
        foreach($tokens as $token) {
            if (is_string($token)) {
                $value = $token;
            } elseif(isset($token[0], $token[1]) && T_WHITESPACE !== $token[0]) {
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
}
