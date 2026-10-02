<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;

interface MemoryCostCapableInterface
{

    /**
     * Set the max memory cost (in kB) in order to use for the hash calculation
     * @param ?int $memory_cost_kb Max kB of memory available to use for the hash calculation
     * @return static The same object
     */
    public function setMemoryCost(?int $memory_cost_kb = null): static;

    /**
     * Retrieve the setted memory cost or the default value
     * @return int The max memory to use
     */
    public function getMemoryCost(): int;
}