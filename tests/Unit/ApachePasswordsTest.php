<?php

namespace JuanchoSL\PasswordHashing\Tests\Unit;

use JuanchoSL\PasswordHashing\Modules\Apache\ApacheHashDigestMd5;
use JuanchoSL\PasswordHashing\Modules\Apache\ApacheHashBasicSha1;
use JuanchoSL\PasswordHashing\Modules\Apache\ApacheApr1BasicMd5;
use PHPUnit\Framework\TestCase;

class ApachePasswordsTest extends TestCase
{


    public static function providerApacheData(): array
    {
        return [
            [new ApacheHashDigestMd5("user", "realm", "password"), md5("user:realm:password"), true],
            [new ApacheHashDigestMd5("usera", "realm", "password"), md5("user:realm:password"), false],
            [new ApacheHashDigestMd5("user", "realn", "password"), md5("user:realm:password"), false],
            [new ApacheHashDigestMd5("user", "realm", "passworda"), md5("user:realm:password"), false],
            [new ApacheHashDigestMd5("user", "realm", "apassword"), md5("user:realm:password"), false],
            [new ApacheHashBasicSha1("password"), '{SHA}' . base64_encode(sha1("password", true)), true],
            [new ApacheHashBasicSha1("password"), '{SHA}' . base64_encode(sha1("passworda", true)), false],
            [new ApacheHashBasicSha1("password"), '{SHA}' . base64_encode(sha1("apassword", true)), false],
            [new ApacheHashBasicSha1("password"), '{SHA}' . sha1("password"), false],
            [new ApacheHashBasicSha1("password"), '{SHA}' . sha1("passworda"), false],
            [new ApacheHashBasicSha1("password"), '{SHA}' . sha1("apassword"), false],
            [new ApacheApr1BasicMd5("password"), (string) new ApacheApr1BasicMd5("password"), true],
            [new ApacheApr1BasicMd5("password"), (string) new ApacheApr1BasicMd5("passworda"), false],
            [new ApacheApr1BasicMd5("password"), (string) new ApacheApr1BasicMd5("apassword"), false],
            [new ApacheApr1BasicMd5("password"), '$apr1$0R.8169N$aamu1e59aLzV7B6u4unAK.', true],//openssl command line
            [new ApacheApr1BasicMd5("passworda"), '$apr1$0R.8169N$aamu1e59aLzV7B6u4unAK.', false],//openssl command line
            [new ApacheApr1BasicMd5("apassword"), '$apr1$0R.8169N$aamu1e59aLzV7B6u4unAK.', false],//openssl command line
        ];
    }

    /**
     * @dataProvider providerApacheData
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
