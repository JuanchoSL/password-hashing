<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait CryptGenerator
{
    use StringGenerator;

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        $salt ??= $this->getAlgo() . $this->getSalt();
        return crypt($plainpasswd, $salt);
    }
}