<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Sodium;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SodiumGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\SodiumValidator;

class Argon2I extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface
{

    use SodiumValidator, SodiumGenerator;

    protected function getAlgo()
    {
        return SODIUM_CRYPTO_PWHASH_ALG_ARGON2I13;
    }

}