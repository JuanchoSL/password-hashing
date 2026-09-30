<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait MemCostSetterTrait
{

    protected ?int $memory_cost = null;

    public function getMemoryCost(): int
    {
        return $this->memory_cost ?? $this->getMemoryCostOptionDefault();
    }

    public function setMemoryCost(?int $memory_cost_kb = null): static
    {
        $this->memory_cost = $memory_cost_kb;
        return $this;
    }

}