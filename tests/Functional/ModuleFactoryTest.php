<?php

namespace JuanchoSL\PasswordHashing\Tests\Functional;

use JuanchoSL\PasswordHashing\Factories\ModuleFactory;
use JuanchoSL\PasswordHashing\Modules\PassHash;
use JuanchoSL\PasswordHashing\Modules\Crypt;
use JuanchoSL\PasswordHashing\Modules\Sodium;
use PHPUnit\Framework\TestCase;

class ModuleFactoryTest extends TestCase
{
    public static function providerHashModule(): array
    {
        return [
            ['password', (string) new Sodium\Argon2I('password')],
            ['password', (string) new Sodium\Argon2ID('password')],
            ['password', (string) new Crypt\CryptBlowfish('password')],
            ['password', (string) new PassHash\Blowfish('password')],
            ['password', (string) new PassHash\Argon2I('password')],
            ['password', (string) new PassHash\Argon2ID('password')],
            //['password', (string) new Apache\ApacheHashDigestMd5('password')],
            //['password', (string) new Openssl\Argon2I('password')],
            //['password', (string) new Openssl\Argon2ID('password')],
        ];
    }
    public static function providerAlgoModule(): array
    {
        return [
            ['password', (string) new Sodium\Argon2I('password'), ModuleFactory::ARGON2I],
            ['password', (string) new Sodium\Argon2ID('password'), ModuleFactory::ARGON2ID],
            ['password', (string) new Crypt\CryptBlowfish('password'), ModuleFactory::BLOWFISH],
            ['password', (string) new Crypt\CryptBlowfish('password'), ModuleFactory::BCRYPT],
            ['password', (string) new PassHash\Blowfish('password'), ModuleFactory::BLOWFISH],
            ['password', (string) new PassHash\Blowfish('password'), ModuleFactory::BCRYPT],
            ['password', (string) new PassHash\Argon2I('password'), ModuleFactory::ARGON2I],
            ['password', (string) new PassHash\Argon2ID('password'), ModuleFactory::ARGON2ID],
            //['password', (string) new Openssl\Argon2I('password')],
            //['password', (string) new Openssl\Argon2ID('password')],
        ];
    }

    /**
     * @dataProvider providerHashModule
     * @param mixed $password
     * @param mixed $hash
     * @return void
     */
    public function testModuleByHash($password, $hash)
    {
        $instance = (new ModuleFactory())->createByHash($hash);
        $this->assertTrue($instance($password));
    }

    /**
     * @dataProvider providerAlgoModule
     * @param mixed $password
     * @param mixed $algo
     * @return void
     */
    public function testModuleByAlgo($password, $hash, $algo)
    {
        $instance = (new ModuleFactory())->createByAlgo($algo);
        $instance = $instance($password);
        $this->assertTrue($instance($hash));
    }
}