<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

trait PasswordValidator
{
    protected function validate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] string $hash): bool
    {
        return password_verify($plainpasswd, $hash);
    }
}