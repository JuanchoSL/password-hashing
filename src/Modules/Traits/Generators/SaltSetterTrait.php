<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

trait SaltSetterTrait
{

    protected ?string $salt = null;

    public function setSalt(?string $salt = null): static
    {
        $this->salt = $salt;
        return $this;
    }

}