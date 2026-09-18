<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Sodium;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\StringGenerator;

class Salsa208Sha256 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface
{

    use StringGenerator;

    protected function getAlgo()
    {
        return '$7$';
    }

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        return sodium_crypto_pwhash_scryptsalsa208sha256_str($plainpasswd, SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE);
    }

    protected function validate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] string $hash): bool
    {
        return sodium_crypto_pwhash_scryptsalsa208sha256_str_verify($hash, $plainpasswd);
    }
}