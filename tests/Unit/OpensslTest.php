<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Openssl\Argon2I;
use JuanchoSL\PasswordHashing\Modules\Openssl\Argon2ID;
use PHPUnit\Framework\TestCase;

class OpensslTest extends TestCase
{


    public static function providerPassData(): array
    {
        return [
            [Argon2I::class, 'password', 'password', true],
            [Argon2ID::class, 'password', 'password', true],
            [Argon2I::class, 'passworda', 'password', false],
            [Argon2ID::class, 'passworda', 'password', false],
        ];
    }


    /**
     * @dataProvider providerPassData
     */
    public function testReadToken($container, $pass1, $pass2, $desired): void
    {
        if(!function_exists('openssl_password_hash')){
            $this->markTestSkipped();
        }
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
