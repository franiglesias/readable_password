<?php
declare (strict_types=1);

namespace TalkingBit\Readable;

interface RandomEngine
{
    public function pickIntegerBetween(int $min, int $max): int;
}
