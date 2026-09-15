<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface LengthCapableInterface
{

    public function setLength(int $length = 0): static;

}