<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Hmac\HashHkdf;
use JuanchoSL\PasswordHashing\Modules\Hmac\HashPbkdf2;
use PHPUnit\Framework\TestCase;

class HmacPasswordsTest extends TestCase
{


    public static function providerHmacPbkdf2Data(): array
    {
        return [
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha224'), hash_pbkdf2('sha224', 'password', 'pass', 10000), true],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha256'), hash_pbkdf2('sha256', 'password', 'pass', 10000), true],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha512'), hash_pbkdf2('sha512', 'password', 'pass', 10000), true],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-256'), hash_pbkdf2('sha3-256', 'password', 'pass', 10000), true],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-512'), hash_pbkdf2('sha3-512', 'password', 'pass', 10000), true],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('whirlpool'), hash_pbkdf2('whirlpool', 'password', 'pass', 10000), true],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha224'), hash_pbkdf2('sha224', 'password', 'passa', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha256'), hash_pbkdf2('sha256', 'password', 'passa', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha512'), hash_pbkdf2('sha512', 'password', 'passa', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-256'), hash_pbkdf2('sha3-256', 'password', 'passa', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-512'), hash_pbkdf2('sha3-512', 'password', 'passa', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('whirlpool'), hash_pbkdf2('whirlpool', 'password', 'passa', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha224'), hash_pbkdf2('sha224', 'password', 'pass', 100000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha256'), hash_pbkdf2('sha256', 'password', 'pass', 100000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha512'), hash_pbkdf2('sha512', 'password', 'pass', 100000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-256'), hash_pbkdf2('sha3-256', 'password', 'pass', 100000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-512'), hash_pbkdf2('sha3-512', 'password', 'pass', 100000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('whirlpool'), hash_pbkdf2('whirlpool', 'password', 'pass', 100000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha256'), hash_pbkdf2('sha224', 'password', 'pass', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha512'), hash_pbkdf2('sha256', 'password', 'pass', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha224'), hash_pbkdf2('sha512', 'password', 'pass', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-512'), hash_pbkdf2('sha3-256', 'password', 'pass', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('sha3-256'), hash_pbkdf2('sha3-512', 'password', 'pass', 10000), false],
            [(new HashPbkdf2('password'))->setIterations(10000)->setSalt('pass')->setAlgorithm('gost'), hash_pbkdf2('whirlpool', 'password', 'pass', 10000), false],
        ];
    }
    public static function providerHmacHkdfData(): array
    {
        return [
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha224'), hash_hkdf('sha224', 'password', 0, '', 'pass'), true],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha256'), hash_hkdf('sha256', 'password', 0, '', 'pass'), true],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha512'), hash_hkdf('sha512', 'password', 0, '', 'pass'), true],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-256'), hash_hkdf('sha3-256', 'password', 0, '', 'pass'), true],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-512'), hash_hkdf('sha3-512', 'password', 0, '', 'pass'), true],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('whirlpool'), hash_hkdf('whirlpool', 'password', 0, '', 'pass'), true],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha224'), hash_hkdf('sha224', 'password', 0, '', 'passa'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha256'), hash_hkdf('sha256', 'password', 0, '', 'passa'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha512'), hash_hkdf('sha512', 'password', 0, '', 'passa'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-256'), hash_hkdf('sha3-256', 'password', 0, '', 'passa'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-512'), hash_hkdf('sha3-512', 'password', 0, '', 'passa'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('whirlpool'), hash_hkdf('whirlpool', 'password', 0, '', 'passa'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha224'), hash_hkdf('sha224', 'password', 0, 'a', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha256'), hash_hkdf('sha256', 'password', 0, 'a', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha512'), hash_hkdf('sha512', 'password', 0, 'a', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-256'), hash_hkdf('sha3-256', 'password', 0, 'a', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-512'), hash_hkdf('sha3-512', 'password', 0, 'a', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('whirlpool'), hash_hkdf('whirlpool', 'password', 0, 'a', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha224'), hash_hkdf('sha224', 'password', 32, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha256'), hash_hkdf('sha256', 'password', 24, '', 'pass'), false],//32 it's true because is the key lenght
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha512'), hash_hkdf('sha512', 'password', 32, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-256'), hash_hkdf('sha3-256', 'password', 24, '', 'pass'), false],//32 it's true because is the key lenght
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-512'), hash_hkdf('sha3-512', 'password', 32, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('whirlpool'), hash_hkdf('whirlpool', 'password', 32, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha256'), hash_hkdf('sha224', 'password', 0, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha512'), hash_hkdf('sha256', 'password', 0, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha224'), hash_hkdf('sha512', 'password', 0, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-512'), hash_hkdf('sha3-256', 'password', 0, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('sha3-256'), hash_hkdf('sha3-512', 'password', 0, '', 'pass'), false],
            [(new HashHkdf('password'))->setSalt('pass')->setAlgorithm('gost'), hash_hkdf('whirlpool', 'password', 0, '', 'pass'), false],
        ];
    }

    /**
     * @dataProvider providerHmacPbkdf2Data
     */
    public function testPbkdf2($container, $hash, $desired): void
    {
        $result = $container($hash);
        if ($desired) {
            $this->assertTrue($result);
        } else {
            $this->assertFalse($result);
        }
    }
    /**
     * @dataProvider providerHmacHkdfData
     */
    public function testHkdf($container, $hash, $desired): void
    {
        $result = $container($hash);
        if ($desired) {
            $this->assertTrue($result);
        } else {
            $this->assertFalse($result);
        }
    }

}
