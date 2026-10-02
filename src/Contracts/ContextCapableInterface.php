<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface ContextCapableInterface
{

    /**
     * Set the context or info to use in order to use when calculate the password hash
     * @param string $context The related context
     * @return static The same object
     */
    public function setContext(string $context): static;

}