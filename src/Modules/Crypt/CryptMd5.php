<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Crypt;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\CryptGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class CryptMd5 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, SaltCapableInterface
{

    use CryptGenerator, HashValidator, SaltSetterTrait, RandomString;

    protected function getAlgo()
    {
        return '$1$';
    }

    protected function getSalt()
    {
        return $this->salt ?? $this->createRandomString(12);
    }
}