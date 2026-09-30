<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Hmac;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\AlgorithmCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\LengthCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\LengthSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\StringGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class HashPbkdf2 extends AbstractPassProtection implements LengthCapableInterface, SaltCapableInterface, AlgorithmCapableInterface, IterationsCapableInterface, GenerationCapableInterface
{

    use HashValidator, SaltSetterTrait, LengthSetterTrait, StringGenerator, IterationsTrait, RandomString;

    protected string $algo = 'sha512';

    public function setAlgorithm(string $algo): static
    {
        $this->algo = $algo;
        return $this;
    }

    protected function getAlgo()
    {
        return $this->algo;
    }
    protected function getIterationsDefault(): mixed
    {
        return 100000;
    }

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        $this->salt ??= $this->createRandomString(16);
        //$salt ??= $this->salt;
        $salt = $this->salt;
        return hash_pbkdf2($this->getAlgo(), $plainpasswd, $salt, $this->getIterations(), $this->length);
    }
}