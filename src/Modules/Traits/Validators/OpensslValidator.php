<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

trait OpensslValidator
{
    protected function validate($plainpasswd, $hash):bool
    {
        return openssl_password_verify($this->getAlgo(), $plainpasswd, $hash);
    }
}