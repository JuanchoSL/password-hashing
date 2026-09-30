<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

trait SodiumRehashingDetection
{

    public function needRehash(#[\SensitiveParameter] string $hash): bool
    {
        return sodium_crypto_pwhash_str_needs_rehash($hash, $this->getIterations(), $this->getMemoryCost());
    }
}