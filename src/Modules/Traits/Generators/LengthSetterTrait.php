<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait LengthSetterTrait
{

    protected int $length = 0;

    public function setLength(int $length = 0): static
    {
        $this->length = $length;
        return $this;
    }

}