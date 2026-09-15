<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

trait HashValidator
{
    protected function validate($plainpasswd, $hash):bool
    {
        return hash_equals($hash, $this->generate($plainpasswd, $hash));
    }
}