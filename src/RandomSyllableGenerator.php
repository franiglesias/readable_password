<?php
declare (strict_types=1);

namespace TalkingBit\Readable;

class RandomSyllableGenerator implements RandomGenerator
{
    private const VOWEL_GROUP = [
        'a',
        'e',
        'i',
        'o',
        'u',
        'ai',
        'au',
        'ei',
        'eu',
        'ia',
        'ie',
        'io',
        'iu',
        'oi',
        'ou',
        'ua',
        'ue',
        'ui',
        'uo'
    ];

    private const CONSONANT_GROUP = [
        'b',
        'c',
        'd',
        'f',
        'g',
        'h',
        'j',
        'k',
        'l',
        'm',
        'n',
        'ñ',
        'p',
        'q',
        'r',
        's',
        't',
        'v',
        'w',
        'x',
        'y',
        'z',
        'bl',
        'br',
        'ch',
        'cl',
        'cr',
        'fl',
        'fr',
        'll',
        'pr',
        'pl',
        'tr',
        ''
    ];

    /** @var RandomEngine */
    private $randomEngine;

    public function __construct(RandomEngine $randomEngine)
    {
        $this->randomEngine = $randomEngine;
    }

    public function generate(): string
    {
        return $this->pickAConsonant() . $this->pickAVowel();
    }

    private function pickAVowel(): string
    {
        $pick = $this->randomEngine->pickIntegerBetween(0, count(self::VOWEL_GROUP) - 1);

        return self::VOWEL_GROUP[$pick];
    }

    private function pickAConsonant(): string
    {
        $pick = $this->randomEngine->pickIntegerBetween(0, count(self::CONSONANT_GROUP));

        return self::CONSONANT_GROUP[$pick];
    }
}
