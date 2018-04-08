<?php
declare (strict_types=1);

namespace TalkingBit\Readable;

interface RandomGenerator
{
    public function generate(): string;
}
