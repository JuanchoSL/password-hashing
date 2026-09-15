<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Crypt;

use JuanchoSL\DataManipulation\Manipulators\Numbers\NumbersManipulators;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\CryptGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class CryptBlowfish extends AbstractPassProtection
{

    use CryptGenerator, HashValidator, RandomString, IterationsTrait, SaltSetterTrait;

    protected function getAlgo()
    {
        return '$2y$';
    }

    protected function getSalt()
    {
        return (string) (new NumbersManipulators($this->getIterations(20)))
            ->logarithmNatural(2)
            ->format(false, 0, false)
            ->padding(2, '0')
            ->concatenation($this->salt ?? $this->createRandomString(22), '$')
            ->concatenation('$', '');
    }
}