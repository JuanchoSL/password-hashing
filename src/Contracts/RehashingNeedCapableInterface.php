<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;

interface RehashingNeedCapableInterface
{
    public function needRehash(#[\SensitiveParameter] string $hash): bool;
}