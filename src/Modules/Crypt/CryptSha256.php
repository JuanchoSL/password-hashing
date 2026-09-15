<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Crypt;

use JuanchoSL\DataManipulation\Manipulators\Numbers\NumbersManipulators;
use JuanchoSL\DataManipulation\Manipulators\Strings\StringsManipulators;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\CryptGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class CryptSha256 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, SaltCapableInterface, IterationsCapableInterface
{

    use CryptGenerator, HashValidator, RandomString, IterationsTrait, SaltSetterTrait;

    protected function getAlgo()
    {
        return '$5$';
    }

    protected function getSalt()
    {
        $iterations = (new NumbersManipulators($this->getIterations(5000)))
            ->max(1000)
            ->min(999999999);
        return (new StringsManipulators("rounds=%d$%s$"))->format((string) $iterations, $this->salt ?? $this->createRandomString(16));
    }
}