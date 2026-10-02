<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait SodiumGenerator
{
    use StringGenerator;

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        return sodium_crypto_pwhash_str($plainpasswd, $this->getIterations(), $this->getMemoryCost());
    }

    protected function getMemoryCostOptionDefault(): int
    {
        return SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE;
    }

    protected function getIterationsDefault(): int
    {
        return SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE;
    }
}