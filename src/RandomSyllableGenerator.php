<?php
declare (strict_types=1);

namespace TalkingBit\Readable;

class RandomSyllableGenerator implements RandomGenerator
{
    private const VOWEL_GROUP = [
        'a', 'e', 'i', 'o', 'u',
        'ai', 'au',
        'ei', 'eu',
        'ia', 'ie', 'io', 'iu',
        'oi', 'ou',
        'ua', 'ue', 'ui', 'uo'
    ];
    /** @var RandomEngine */
    private $randomEngine;

    public function __construct(RandomEngine $randomEngine)
    {
        $this->randomEngine = $randomEngine;
    }

    public function generate(): string
    {
        $pick = $this->randomEngine->pickIntegerBetween(0, count(self::VOWEL_GROUP) - 1);

        return self::VOWEL_GROUP[$pick];
    }
}
