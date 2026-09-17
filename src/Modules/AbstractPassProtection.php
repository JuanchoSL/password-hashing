<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules;

use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;

abstract class AbstractPassProtection implements ValidationCapableInterface
{

    protected $password;

    public function __construct(#[\SensitiveParameter] string $password)
    {
        $this->password = $password;
    }

    public function __invoke(#[\SensitiveParameter] string $hash): bool
    {
        return $this->validate($this->password, $hash);
    }

    abstract protected function validate(#[\SensitiveParameter] string $password, #[\SensitiveParameter] string $hash): bool;
}