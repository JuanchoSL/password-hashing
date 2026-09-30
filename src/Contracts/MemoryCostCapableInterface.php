<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;

interface MemoryCostCapableInterface
{

    public function setMemoryCost(?int $memory_cost_kb = null): static;

    public function getMemoryCost(): int;
}