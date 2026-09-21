<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Crypt\CryptBlowfish;
use JuanchoSL\PasswordHashing\Modules\Crypt\CryptExtendedDes;
use JuanchoSL\PasswordHashing\Modules\Crypt\CryptMd5;
use JuanchoSL\PasswordHashing\Modules\Crypt\CryptSha256;
use JuanchoSL\PasswordHashing\Modules\Crypt\CryptSha512;
use JuanchoSL\PasswordHashing\Modules\Crypt\CryptStandardDes;
use PHPUnit\Framework\TestCase;

class CryptPasswordsTest extends TestCase
{


    public static function providerCryptData(): array
    {
        return [
            [(new CryptBlowfish('password'))->setIterations(16)->setSalt('123456789.asdfghjkloiu'), 'password', true],
            [(new CryptStandardDes('password'))->setSalt('as'), 'password', true],
            [(new CryptExtendedDes('password'))->setIterations(725)->setSalt('pass'), 'password', true],
            [(new CryptMd5('password')), 'password', true],
            [(new CryptSha256('password'))->setIterations(1000)->setSalt('qwercv1234567890'), 'password', true],
            [(new CryptSha512('password'))->setIterations(1000)->setSalt('qwercv1234567890'), 'password', true],
            [(new CryptBlowfish('password'))->setIterations(16)->setSalt('123456789.asdfghjkloiu'), 'passworda', false],
            [(new CryptStandardDes('password'))->setSalt('as'), 'apassword', false],
            [(new CryptExtendedDes('password'))->setIterations(725)->setSalt('pass'), 'passworda', false],
            [(new CryptMd5('password')), 'passworda', false],
            [(new CryptSha256('password'))->setIterations(1000)->setSalt('qwercv1234567890'), 'passworda', false],
            [(new CryptSha512('password'))->setIterations(1000)->setSalt('qwercv1234567890'), 'passworda', false],
            
            [(new CryptStandardDes('password'))->setSalt('as'), 'passworda', true],//be carefull, only first 8 chars are used, for this reason, it evaluate true
        ];
    }

    /**
     * @dataProvider providerCryptData
     */
    public function testReadToken($container, $pass, $desired): void
    {
        $hash = (string) $container;
        $container = get_class($container);
        $container = new $container($pass);
        $result = $container($hash);
        if ($desired) {
            $this->assertTrue($result);
        } else {
            $this->assertFalse($result);
        }
    }
}
