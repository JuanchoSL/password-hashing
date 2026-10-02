<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Hmac;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\AlgorithmCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\LengthCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\LengthSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\StringGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class HashHkdf extends AbstractPassProtection implements
    LengthCapableInterface,
    SaltCapableInterface,
    AlgorithmCapableInterface,
    GenerationCapableInterface
{

    use HashValidator, SaltSetterTrait, LengthSetterTrait, StringGenerator, RandomString;

    protected string $algo = 'sha512';

    public function setAlgorithm(string $algo): static
    {
        $this->algo = $algo;
        return $this;
    }

    protected function getAlgo(): string
    {
        return $this->algo;
    }

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        $this->salt ??= $this->createRandomString(16);
        //$salt ??= $this->salt;
        $salt = $this->salt;
        return hash_hkdf($this->getAlgo(), $plainpasswd, $this->length, '', $salt);
    }
}