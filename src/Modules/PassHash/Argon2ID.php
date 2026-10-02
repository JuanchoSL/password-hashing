<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\PassHash;

use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\MemoryCostCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\MemCostSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\PasswordGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\PasswordValidator;

class Argon2ID extends AbstractArgon2 implements GenerationCapableInterface, ValidationCapableInterface, MemoryCostCapableInterface, IterationsCapableInterface
{

    use PasswordGenerator, PasswordValidator, MemCostSetterTrait, IterationsTrait;

    protected function getAlgo(): string
    {
        return PASSWORD_ARGON2ID;
    }
}