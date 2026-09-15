<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait StringGenerator
{
    public function __toString(): string
    {
        return $this->generate($this->password);
    }
}