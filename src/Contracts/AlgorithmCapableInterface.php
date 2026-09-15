<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface AlgorithmCapableInterface
{

    public function setAlgorithm(string $algo): static;

}