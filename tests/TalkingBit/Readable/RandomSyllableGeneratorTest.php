<?php
declare (strict_types=1);

namespace Tests\TalkingBit\Readable;

use PHPUnit\Framework\TestCase;
use TalkingBit\Readable\RandomEngine;
use TalkingBit\Readable\RandomSyllableGenerator;

class RandomSyllableGeneratorTest extends TestCase
{

    const VOWEL_GROUP_PATTERN = '/[aeiou]|ai|au|ei|eu|ia|ie|io|iu|oi|ou|ua|ue|ui|uo/';

    public function testASyllableHasOneVowelGroup()
    {
        $engineProphecy = $this->prophesize(RandomEngine::class);
        $engineProphecy->pickIntegerBetween(0, 18)->willReturn(4);
        $generator = new RandomSyllableGenerator($engineProphecy->reveal());
        $this->assertValidVowelGroup($generator->generate());
    }

    public function assertValidVowelGroup(string $syllable): void
    {
        $this->assertRegExp(self::VOWEL_GROUP_PATTERN, $syllable);
    }
}
