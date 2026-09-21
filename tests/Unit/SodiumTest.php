<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Sodium\Argon2ID;
use JuanchoSL\PasswordHashing\Modules\Sodium\Salsa208Sha256;
use PHPUnit\Framework\TestCase;

class SodiumTest extends TestCase
{


    public static function providerPassData(): array
    {
        return [
            [Argon2ID::class, 'password', 'password', true],
            [Argon2ID::class, 'passworda', 'password', false],
            [Salsa208Sha256::class, 'password', 'password', true],
            [Salsa208Sha256::class, 'passworda', 'password', false],
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
