<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Apache;

use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\HashGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class ApacheHashDigestMd5 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface
{

    use HashGenerator, HashValidator;

    public function __construct(string $username, string $realm, #[\SensitiveParameter] string $password)
    {
        parent::__construct($username . ":" . $realm . ":" . $password);
    }

    protected function getAlgo()
    {
        return 'md5';
    }

}