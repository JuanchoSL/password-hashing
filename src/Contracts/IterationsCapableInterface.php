<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface IterationsCapableInterface
{

    public function setIterations(int $iterations): static;

    public function getIterations(int $default = 5000): int;
}