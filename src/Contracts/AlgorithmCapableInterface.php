<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface AlgorithmCapableInterface
{

    /**
     * Set the desired algorithm in order to use for hash calculation
     * @param string $algo A valid algorithm included into hash_algos or hash_hmac_algos
     * @return static The same object
     */
    public function setAlgorithm(string $algo): static;

}