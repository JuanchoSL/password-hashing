<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules;

use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;

abstract class AbstractPassProtection implements ValidationCapableInterface
{

    protected string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function __invoke(string $hash): bool
    {
        return $this->validate($this->password, $hash);
    }

    abstract protected function validate(string $password, string $hash): bool;
}