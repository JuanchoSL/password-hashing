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
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SodiumGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\SodiumRehashingDetection;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\SodiumValidator;

class Argon2I extends AbstractPassProtection implements
    GenerationCapableInterface,
    ValidationCapableInterface,
    MemoryCostCapableInterface,
    IterationsCapableInterface,
    RehashingNeedCapableInterface
{

    use SodiumValidator, SodiumGenerator, MemCostSetterTrait, IterationsTrait, SodiumRehashingDetection;

    protected function getAlgo()
    {
        return SODIUM_CRYPTO_PWHASH_ALG_ARGON2I13;
    }

}