<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Crypt;

use JuanchoSL\DataManipulation\Manipulators\Numbers\NumbersManipulators;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\PassHash\Blowfish;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\CryptGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;

class CryptBlowfish extends AbstractCrypt implements SaltCapableInterface, IterationsCapableInterface, GenerationCapableInterface, ValidationCapableInterface
{

    use CryptGenerator, RandomString, IterationsTrait, SaltSetterTrait;

    protected function getAlgo()
    {
        return '$2y$';
    }

    protected function getSalt()
    {
        return (string) (new NumbersManipulators($this->getIterations()))
            ->logarithmNatural(2)
            ->format(false, 0, false)
            ->padding(2, '0')
            ->concatenation($this->salt ?? $this->createRandomString(22), '$')
            ->concatenation('$', '');
    }

    protected function validate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] string $hash): bool
    {
        if (str_starts_with($hash, $this->getAlgo())) {
            $obj = new Blowfish($plainpasswd);
            return $obj($hash);
        }
        return parent::validate($hash, $hash);
    }
}