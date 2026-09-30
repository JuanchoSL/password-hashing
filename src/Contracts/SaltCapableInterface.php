<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Contracts;


interface SaltCapableInterface
{

    /**
     * Set the salt to use in order to calculate the password hash
     * @param string $salt The desired salt
     * @return static The same object
     */
    public function setSalt(string $salt): static;

}