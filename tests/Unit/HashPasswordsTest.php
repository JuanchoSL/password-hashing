<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Hash\Digest;
use PHPUnit\Framework\TestCase;

class HashPasswordsTest extends TestCase
{


    public static function providerHashData(): array
    {
        return [
            [(new Digest('password'))->setAlgorithm('sha224'), hash('sha224', 'password'), true],
            [(new Digest('password'))->setAlgorithm('sha256'), hash('sha256', 'password'), true],
            [(new Digest('password'))->setAlgorithm('sha512'), hash('sha512', 'password'), true],
            [(new Digest('password'))->setAlgorithm('sha3-256'), hash('sha3-256', 'password'), true],
            [(new Digest('password'))->setAlgorithm('sha3-512'), hash('sha3-512', 'password'), true],
            [(new Digest('password'))->setAlgorithm('whirlpool'), hash('whirlpool', 'password'), true],
            [(new Digest('password'))->setAlgorithm('sha256'), hash('sha224', 'password'), false],
            [(new Digest('password'))->setAlgorithm('sha512'), hash('sha256', 'password'), false],
            [(new Digest('password'))->setAlgorithm('sha224'), hash('sha512', 'password'), false],
            [(new Digest('password'))->setAlgorithm('sha3-512'), hash('sha3-256', 'password'), false],
            [(new Digest('password'))->setAlgorithm('sha3-256'), hash('sha3-512', 'password'), false],
            [(new Digest('password'))->setAlgorithm('gost'), hash('whirlpool', 'password'), false],
        ];
    }

    /**
     * @dataProvider providerHashData
     */
    public function testReadToken($container, $hash, $desired): void
    {
        $result = $container($hash);
        if ($desired) {
            $this->assertTrue($result);
        } else {
            $this->assertFalse($result);
        }
    }

}
