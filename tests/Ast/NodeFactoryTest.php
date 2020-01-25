<?php

declare(strict_types=1);

namespace Ksaveras\MathCalculator\Test\Ast;

use Ksaveras\MathCalculator\Ast\NodeFactory;
use PHPUnit\Framework\TestCase;

class NodeFactoryTest extends TestCase
{
    /**
     * @dataProvider validTokenProvider
     */
    public function testCreateNode(string $token): void
    {
        $factory = new NodeFactory();

        $node = $factory->createNode($token);
        $this->assertIsObject($node);
    }

    public function validTokenProvider(): \Generator
    {
        yield ['0'];
        yield ['10'];
        yield ['5.5'];
        yield ['-4'];
        yield ['+'];
        yield ['-'];
        yield ['*'];
        yield ['/'];
        yield ['|'];
        yield ['&'];
    }

    /**
     * @dataProvider invalidTokenProvider
     */
    public function testCreateInvalidToken(string $token): void
    {
        $this->expectException(\LogicException::class);

        $factory = new NodeFactory();

        $factory->createNode($token);
    }

    public function invalidTokenProvider(): \Generator
    {
        yield ['a'];
        yield ['_'];
        yield ['?'];
        yield ['4a'];
        yield ['a4'];
        yield ['!'];
        yield ['--'];
    }
}
