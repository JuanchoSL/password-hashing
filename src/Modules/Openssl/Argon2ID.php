<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Openssl;

use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\MemoryCostCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\MemCostSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\OpensslGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\OpensslValidator;

class Argon2ID extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, IterationsCapableInterface, MemoryCostCapableInterface
{

    use OpensslGenerator, OpensslValidator, IterationsTrait, MemCostSetterTrait;

    protected function getAlgo(): string
    {
        return PASSWORD_ARGON2ID;
    }
}