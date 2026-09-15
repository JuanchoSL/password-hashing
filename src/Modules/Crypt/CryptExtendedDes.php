<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Modules\Crypt;

use JuanchoSL\PasswordHashing\Modules\AbstractPassProtection;
use JuanchoSL\PasswordHashing\Contracts\GenerationCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\IterationsCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\SaltCapableInterface;
use JuanchoSL\PasswordHashing\Contracts\ValidationCapableInterface;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\CryptGenerator;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\IterationsTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\RandomString;
use JuanchoSL\PasswordHashing\Modules\Traits\Generators\SaltSetterTrait;
use JuanchoSL\PasswordHashing\Modules\Traits\Validators\HashValidator;

class CryptExtendedDes extends AbstractPassProtection implements GenerationCapableInterface, ValidationCapableInterface, IterationsCapableInterface, SaltCapableInterface
{

    use CryptGenerator, HashValidator, RandomString, IterationsTrait, SaltSetterTrait;
    protected int $iterations;
    protected function getAlgo()
    {
        return '';
    }

    protected function getSalt()
    {
        $string = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $val = $this->getIterations();
        $char = '';
        foreach ([3, 2, 1, 0] as $value) {
            $exp = empty($value) ? 1 : (64 ** $value);
            $pow = $val / $exp;
            $char .= $string[intval($pow)];
            $val -= $exp * intval($pow);
        }
        return '_' . strrev($char) . $this->salt ?? $this->createRandomString(4) . '$';

        //reverso
        $char = 'zzzz';
        $val = 0;
        foreach (str_split($char) as $index => $char) {
            $pos = strpos($string, $char);
            $val += $pos * (64 ** $index);
        }
        echo $val;
    }
}