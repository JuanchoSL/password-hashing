<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait IterationsTrait
{

    protected ?int $iterations = null;

    public function setIterations(int $iterations): static
    {
        $this->iterations = $iterations;
        return $this;
    }

    public function getIterations(): int
    {
        return $this->iterations ?? $this->getIterationsDefault();
    }
}