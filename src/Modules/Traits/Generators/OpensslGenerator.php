<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait OpensslGenerator
{

    use StringGenerator;
    protected function generate(string $plainpasswd, ?string $salt = null): string
    {
        return openssl_password_hash($salt ?? $this->getAlgo(), $plainpasswd);
    }
}