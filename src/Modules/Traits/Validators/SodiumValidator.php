<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

trait SodiumValidator
{
    protected function validate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] string $hash): bool
    {
        return sodium_crypto_pwhash_str_verify($hash, $plainpasswd);
    }
}