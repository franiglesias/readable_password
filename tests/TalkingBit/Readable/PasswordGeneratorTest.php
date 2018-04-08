<?php
declare (strict_types=1);

namespace Tests\TalkingBit\Readable;

use PHPUnit\Framework\TestCase;
use TalkingBit\Readable\PasswordGenerator;
use TalkingBit\Readable\RandomGenerator;

class PasswordGeneratorTest extends TestCase
{

    public function testItGeneratesAStringWithAMinimumLength()
    {
        $generator = new PasswordGenerator();
        $password = $generator->generate();
        $this->assertGreaterThanOrEqual(PasswordGenerator::MINIMUM_LENGTH, strlen($password));
    }

    public function testItGeneratesAPasswordUsingSymbolsPickedfromRandomGeneartor()
    {
        $randomProphecy = $this->prophesize(RandomGenerator::class);
        $randomProphecy->generate()->willReturn('1', '2', '3', '4', '5', '6');
        $generator = new PasswordGenerator($randomProphecy->reveal());
        $password = $generator->generate();
        $this->assertEquals('123456', $password);
    }
}

