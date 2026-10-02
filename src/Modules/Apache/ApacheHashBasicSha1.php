<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Apache;

use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\StringGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class ApacheHashBasicSha1 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface
{

    use StringGenerator, HashValidator;

    protected function getAlgo(): string
    {
        return '{SHA}';
    }

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        return $this->getAlgo() . base64_encode(sha1($plainpasswd, true));
    }
}