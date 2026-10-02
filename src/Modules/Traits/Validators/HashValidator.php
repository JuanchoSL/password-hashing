<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Validators;

use JuanchoSL\DataManipulation\Manipulators\Strings\StringsManipulators;
use JuanchoSL\Validators\Types\Strings\StringValidation;

trait HashValidator
{
    protected function validate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] string $hash): bool
    {
        $hashed = $this->generate($plainpasswd, $hash);
        $hash = StringValidation::isBinary($hash) ? (string) (new StringsManipulators($hash))->binToHex() : $hash;
        $hashed = StringValidation::isBinary($hashed) ? (string) (new StringsManipulators($hashed))->binToHex() : $hashed;
        return hash_equals($hash, $hashed);
    }
}