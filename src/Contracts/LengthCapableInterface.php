<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface LengthCapableInterface
{

    /**
     * Set the max length for the hash result from the compatible instances
     * @param int $length The max length of the result
     * @return static The same object
     */
    public function setLength(int $length = 0): static;

}