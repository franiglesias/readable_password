<?php
declare (strict_types=1);

namespace TalkingBit\Readable;

class PasswordGenerator
{
    public const MINIMUM_LENGTH = 6;
    /**
     * @var RandomGenerator
     */
    private $randomGenerator;

    public function __construct(RandomGenerator $randomGenerator)
    {
        $this->randomGenerator = $randomGenerator;
    }

    public function generate(): string
    {
        $password = '';
        for ($item = 0; $item < self::MINIMUM_LENGTH; $item++) {
            $password .= $this->randomGenerator->generate();
        }
        return $password;
    }
}
