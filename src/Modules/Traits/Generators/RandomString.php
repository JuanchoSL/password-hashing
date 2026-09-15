<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Traits\Generators;

use JuanchoSL\DataManipulation\Manipulators\Strings\StringsManipulators;

trait RandomString
{

    protected function createRandomString(int $length, string $chars = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz')
    {
        $string = (string) (new StringsManipulators($chars))->shuffle()->shuffle();
        $max = strlen($string);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $string[rand(0, $max - 1)];
        }
        return $result;
    }
}