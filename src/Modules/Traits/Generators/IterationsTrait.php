<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait IterationsTrait
{

    protected int $iterations;

    public function setIterations(int $iterations): static
    {
        $this->iterations = $iterations;
        return $this;
    }

    public function getIterations(int $default = 5000): int
    {
        return $this->iterations ?? $default;
    }
}