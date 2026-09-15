<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\PassHash;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\PasswordGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\PasswordValidator;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
class Blowfish extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface
{

    use PasswordGenerator, PasswordValidator;

    protected function getAlgo()
    {
        return PASSWORD_BCRYPT;
    }
}