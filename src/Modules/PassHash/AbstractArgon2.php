<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\PassHash;

use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\MemoryCostCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\RehashingNeedCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\PasswordRehashingDetection;

abstract class AbstractArgon2 extends AbstractPassProtection implements IterationsCapableInterface, MemoryCostCapableInterface, RehashingNeedCapableInterface
{

    use PasswordRehashingDetection;

    protected function getMemoryCostOptionDefault(): mixed
    {
        return PASSWORD_ARGON2_DEFAULT_MEMORY_COST;
    }

    protected function getIterationsDefault(): mixed
    {
        return PASSWORD_ARGON2_DEFAULT_TIME_COST;
    }
    protected function getMemoryCostOptionName(): string
    {
        return 'memory_cost';
    }
    protected function getIterationsOptionName(): string
    {
        return 'time_cost';
    }

    protected function getOptions(): mixed
    {
        return [
            $this->getMemoryCostOptionName() => $this->getMemoryCost(),
            $this->getIterationsOptionName() => $this->getIterations(),
        ];
    }
}