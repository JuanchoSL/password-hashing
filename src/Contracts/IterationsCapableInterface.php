<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;

interface IterationsCapableInterface
{

    /**
     * Set the desired iterations in order to create a stronger hash
     * @param int $iterations The number of iterations
     * @return static The same object
     */
    public function setIterations(int $iterations): static;

    /**
     * Retrieve the setted iterations or the default value for the instance
     * @return int the value to use
     */
    public function getIterations(): int;
}