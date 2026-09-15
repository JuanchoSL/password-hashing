<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

use Exception;

trait AlgorithmSetterTrait
{

    protected string $algorithm = 'sha256';

    public function setAlgorithm(string $algorithm): static
    {
        if (!in_array($algorithm, hash_algos())) {
            throw new Exception(sprintf("Invalid algorithm '%s'", $algorithm));
        }
        $this->algorithm = $algorithm;
        return $this;
    }

}