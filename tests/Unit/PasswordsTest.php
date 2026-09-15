<?php

namespace JuanchoSL\PasswordHashing\Tests\Integration;

use JuanchoSL\PasswordHashing\Modules\PassHash\Argon2I;
use JuanchoSL\PasswordHashing\Modules\PassHash\Argon2ID;
use JuanchoSL\PasswordHashing\Modules\PassHash\Blowfish;
use PHPUnit\Framework\TestCase;

class PasswordsTest extends TestCase
{


    public static function providerPassData(): array
    {
        return [
            [Blowfish::class, 'password', 'password', true],
            [Argon2I::class, 'password', 'password', true],
            [Argon2ID::class, 'password', 'password', true],
            [Blowfish::class, 'passworda', 'password', false],
            [Argon2I::class, 'passworda', 'password', false],
            [Argon2ID::class, 'passworda', 'password', false],
        ];
    }


    /**
     * @dataProvider providerPassData
     */
    public function testReadToken($container, $pass1, $pass2, $desired): void
    {
        $container1 = new $container($pass1);
        $container2 = new $container($pass2);
        $hash = (string) $container1;
        $result = $container2($hash);
        if ($desired) {
            $this->assertTrue($result);
        } else {
            $this->assertFalse($result);
        }
    }

}
