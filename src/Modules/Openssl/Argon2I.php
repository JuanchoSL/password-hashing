<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Openssl;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\OpensslGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\OpensslValidator;

class Argon2I extends AbstractPassProtection
{

    use OpensslGenerator, OpensslValidator;

    protected function getAlgo()
    {
        return PASSWORD_ARGON2I;
    }
}