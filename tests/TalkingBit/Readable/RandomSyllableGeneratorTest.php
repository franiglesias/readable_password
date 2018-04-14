<?php
declare (strict_types=1);

namespace Tests\TalkingBit\Readable;

use PHPUnit\Framework\TestCase;
use TalkingBit\Readable\RandomEngine;
use TalkingBit\Readable\RandomSyllableGenerator;

class RandomSyllableGeneratorTest extends TestCase
{

    const VOWEL_GROUP_PATTERN = '[aeiou]|ai|au|ei|eu|ia|ie|io|iu|oi|ou|ua|ue|ui|uo';
    const CONSONANT_GROUP_PATTERN = '[^aeiou]|bl|br|ch|cl|cr|fl|fr|ll|pr|pl|tr';

    public function testASyllableHasOneVowelGroup()
    {
        $engineProphecy = $this->prophesize(RandomEngine::class);
        $engineProphecy->pickIntegerBetween(0, 18)->willReturn(4);
        $engineProphecy->pickIntegerBetween(0, 33)->willReturn(0);
        $generator = new RandomSyllableGenerator($engineProphecy->reveal());
        $this->assertValidVowelGroup($generator->generate());
    }

    public function testASyllableCanStartWithOneConsonantGroup()
    {
        $engineProphecy = $this->prophesize(RandomEngine::class);
        $engineProphecy->pickIntegerBetween(0, 18)->willReturn(0);
        $engineProphecy->pickIntegerBetween(0, 33)->willReturn(0);
        $generator = new RandomSyllableGenerator($engineProphecy->reveal());
        $this->assertStartsWithConsonantGroup($generator->generate());
    }

    public function assertValidVowelGroup(string $syllable): void
    {
        $this->assertRegExp(sprintf('/%s/', self::VOWEL_GROUP_PATTERN), $syllable);
    }

    private function assertStartsWithConsonantGroup(string $syllable): void
    {
        $pattern = sprintf('/^(%s)%s/', self::CONSONANT_GROUP_PATTERN, self::VOWEL_GROUP_PATTERN);
        $this->assertRegExp($pattern, $syllable);
    }
}
