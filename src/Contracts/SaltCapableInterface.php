<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface SaltCapableInterface
{

    public function setSalt(string $salt): static;

}