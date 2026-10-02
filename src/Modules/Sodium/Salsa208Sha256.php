<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Sodium;

use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\MemoryCostCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\RehashingNeedCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\MemCostSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\StringGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\SodiumRehashingDetection;

class Salsa208Sha256 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, IterationsCapableInterface, MemoryCostCapableInterface, RehashingNeedCapableInterface
{

    use StringGenerator, IterationsTrait, MemCostSetterTrait, SodiumRehashingDetection, SodiumRehashingDetection;

    protected function getAlgo(): string
    {
        return SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_STRPREFIX;//'$7$';
    }

    protected function getIterationsDefault(): int
    {
        return SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE;
    }

    protected function getMemoryCostOptionDefault(): int
    {
        return SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE;
    }

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        return sodium_crypto_pwhash_scryptsalsa208sha256_str($plainpasswd, $this->getIterations(), $this->getMemoryCost() * 1024);
    }

    protected function validate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] string $hash): bool
    {
        return sodium_crypto_pwhash_scryptsalsa208sha256_str_verify($hash, $plainpasswd);
    }
}