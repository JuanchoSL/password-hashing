<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

trait PasswordRehashingDetection
{

    public function needRehash(#[\SensitiveParameter] string $hash): bool
    {
        return password_needs_rehash($hash, $this->getAlgo(), $this->getOptions());
    }
}