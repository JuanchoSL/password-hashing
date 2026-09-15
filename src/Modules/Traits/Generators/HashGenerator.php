<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait HashGenerator
{
    use StringGenerator;

    protected function generate(string $plainpasswd, ?string $salt = null): string
    {
        return hash($this->getAlgo(), $plainpasswd);
    }
}