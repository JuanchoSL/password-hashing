<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait PasswordGenerator
{

    use StringGenerator;
    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        return password_hash($plainpasswd, $salt ?? $this->getAlgo());
    }
}