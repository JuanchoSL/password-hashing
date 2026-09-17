<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface ValidationCapableInterface
{
    public function __invoke(#[\SensitiveParameter] string $hash): bool;
}