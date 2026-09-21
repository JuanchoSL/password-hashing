<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Apache\ApacheHashBasicSha1;
use JuanchoSL\PasswordHashing\Modules\Crypt\CryptBlowfish;
use JuanchoSL\PasswordHashing\Modules\Hash\Digest;
use JuanchoSL\PasswordHashing\Modules\PassHash\Blowfish;
use JuanchoSL\PasswordHashing\Modules\PassHash\Argon2ID as PassArgon2ID;
use JuanchoSL\PasswordHashing\Modules\Sodium\Argon2ID as SodiumArgon2ID;

use PHPUnit\Framework\TestCase;

class CombineModulesTest extends TestCase
{

    public function testArgon2CombineModules()
    {
        $sodium = new SodiumArgon2ID('password');
        $pass_hash = new PassArgon2ID('password');
        $this->assertTrue($pass_hash((string) $sodium));
        $this->assertTrue($sodium((string) $pass_hash));
    }

    public function testBlowfishCombineModules()
    {
        $pass_hash = new Blowfish('password');
        $crypt = new CryptBlowfish('password');
        $this->assertTrue($crypt((string) $pass_hash));
        $this->assertTrue($pass_hash((string) $crypt));
    }

    public function testSha1CombineModules()
    {
        $apache = new ApacheHashBasicSha1("password");
        $digest = (new Digest('password'))->setAlgorithm('sha1');
        $this->assertTrue($apache('{SHA}' . base64_encode(hex2bin((string) $digest))));
        $this->assertTrue($digest(bin2hex(base64_decode(str_replace('{SHA}', '', (string) $apache)))));
    }
}
