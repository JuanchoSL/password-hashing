<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Apache;

use JuanchoSL\DataManipulation\Manipulators\Strings\StringsManipulators;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\StringGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class ApacheApr1BasicMd5 extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, SaltCapableInterface
{

    use HashValidator, StringGenerator, RandomString, SaltSetterTrait;

    protected function getAlgo()
    {
        return '$apr1$';
    }

    protected function getSalt()
    {
        return $this->salt ?? $this->createRandomString(8, "abcdefghijklmnopqrstuvwxyz0123456789");
    }

    protected function generate(#[\SensitiveParameter] string $plainpasswd, #[\SensitiveParameter] ?string $salt = null): string
    {
        $salt = (new StringsManipulators($salt ?? $this->getSalt()))->replace($this->getAlgo(), '')->substring(0, 8);
        $text = (string) $salt->preppend($this->getAlgo(), '')->preppend($plainpasswd, '');
        $bin = pack("H32", (string) $salt->preppend($plainpasswd, '')->concatenation($plainpasswd, '')->md5());
        $salt = (string) $salt;

        $len = strlen($plainpasswd);
        for ($i = $len; $i > 0; $i -= 16) {
            $text .= substr($bin, 0, $i > 16 ? 16 : $i);
        }

        for ($i = $len; $i > 0; $i >>= 1) {
            $text .= ($i & 1) ? chr(0) : $plainpasswd[0];
        }

        $bin = pack("H32", md5($text));

        // Bucle de iteración interna de Apache (1000 vueltas)
        for ($i = 0; $i < 1000; $i++) {
            $new = ($i & 1) ? $plainpasswd : substr($bin, 0, 16);
            if ($i % 3)
                $new .= $salt;
            if ($i % 7)
                $new .= $plainpasswd;
            $new .= ($i & 1) ? substr($bin, 0, 16) : $plainpasswd;
            $bin = pack("H32", md5($new));
        }

        // Conversión personalizada a Base64 según el estándar de Apache APR1
        $tmp = '';
        $to64 = function ($v, $n) {
            $ITOA64 = "./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $ret = '';
            while (--$n >= 0) {
                $ret .= $ITOA64[$v & 0x3f];
                $v >>= 6;
            }
            return $ret;
        };

        $tmp .= $to64((ord($bin[0]) << 16) | (ord($bin[6]) << 8) | ord($bin[12]), 4);
        $tmp .= $to64((ord($bin[1]) << 16) | (ord($bin[7]) << 8) | ord($bin[13]), 4);
        $tmp .= $to64((ord($bin[2]) << 16) | (ord($bin[8]) << 8) | ord($bin[14]), 4);
        $tmp .= $to64((ord($bin[3]) << 16) | (ord($bin[9]) << 8) | ord($bin[15]), 4);
        $tmp .= $to64((ord($bin[4]) << 16) | (ord($bin[10]) << 8) | ord($bin[5]), 4);
        $tmp .= $to64(ord($bin[11]), 2);

        return $this->getAlgo() . $salt . '$' . $tmp;
    }
}