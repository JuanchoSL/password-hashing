<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Hash;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\AlgorithmCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\AlgorithmSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\HashGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class Digest extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, AlgorithmCapableInterface
{

    use HashGenerator, HashValidator, AlgorithmSetterTrait;

    protected function getAlgo()
    {
        return $this->algorithm;
    }
}