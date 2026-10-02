<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait OpensslGenerator
{

    use StringGenerator;

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        return \openssl_password_hash($salt ?? $this->getAlgo(), $plainpasswd, $this->getOptions());
    }

    protected function getMemoryCostOptionDefault(): int
    {
        return PASSWORD_ARGON2_DEFAULT_MEMORY_COST;
    }

    protected function getIterationsDefault(): int
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

    
    /**
     * @return array<string, int>
     */
    protected function getOptions(): array
    {
        $opt = [];
        if (!is_null($this->iterations)) {
            $opt[$this->getIterationsOptionName()] = $this->getIterations();
        }
        if (!is_null($this->memory_cost)) {
            $opt[$this->getMemoryCostOptionName()] = $this->getMemoryCost();
        }
        return $opt;
    }
}