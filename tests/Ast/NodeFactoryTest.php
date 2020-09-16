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
        self::assertIsObject($node);
    }

    /**
     * @return \Generator<array<int, string>>
     */
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

    /**
     * @return \Generator<array<int, string>>
     */
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
