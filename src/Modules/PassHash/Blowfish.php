<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\PassHash;

use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\PasswordGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\PasswordValidator;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;

class Blowfish extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, SaltCapableInterface
{

    use PasswordGenerator, PasswordValidator, SaltSetterTrait;

    protected function getAlgo()
    {
        return PASSWORD_BCRYPT;
    }

    protected function getOptions(): mixed
    {
        $opt = [];
        if (!is_null($this->salt)) {
            $opt['salt'] = $this->salt;
        }
        return $opt;
    }
}