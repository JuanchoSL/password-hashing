<?php declare(strict_types=1);

namespace JuanchoSL\PasswordHashing\Factories;

use JuanchoSL\DataManipulation\Manipulators\Strings\StringsManipulators;
use JuanchoSL\Validators\Types\Strings\StringValidation;
use JuanchoSL\PasswordHashing\Modules\Openssl;
use JuanchoSL\PasswordHashing\Modules\PassHash;
use JuanchoSL\PasswordHashing\Modules\Crypt;
use JuanchoSL\PasswordHashing\Modules\Apache;
use JuanchoSL\PasswordHashing\Modules\Hash;
use JuanchoSL\PasswordHashing\Modules\Sodium;

class ModuleFactory
{

    const DIGEST_MD5 = '1';
    const DIGEST_SHA256 = '5';
    const DIGEST_SHA512 = '6';
    const SALSA208_SHA256 = '7';
    const APACHE_APR1 = 'apr1';
    const APACHE_MD5 = 'md5';
    const APACHE_SHA1 = '{SHA}';
    const BCRYPT = PASSWORD_BCRYPT;
    const BLOWFISH = PASSWORD_BCRYPT;
    const ARGON2I = PASSWORD_ARGON2I;
    const ARGON2ID = PASSWORD_ARGON2ID;

    protected string $password;
    protected string $hash;
    protected $instance;

    public function __invoke(#[\SensitiveParameter] string $password)
    {
        $instance = $this->instance;
        $instance = new $instance($password);
        return (empty($this->hash)) ? $instance : $instance($this->hash);
    }

    public function createByAlgo(string $algo): static
    {
        unset($this->hash);
        $this->instance = $this->_createByAlgo($algo);
        return $this;
    }

    protected function _createByAlgo(string $algo)
    {
        switch ($algo) {
            case self::BCRYPT:
            case self::BLOWFISH:
                return (function_exists('crypt')) ? Crypt\CryptBlowfish::class : PassHash\Blowfish::class;

            case self::ARGON2I:
                return (function_exists('openssl_password_verify') && function_exists('openssl_password_hash')) ? Openssl\Argon2I::class : PassHash\Argon2I::class;

            case self::ARGON2ID:
                return (function_exists('openssl_password_verify') && function_exists('openssl_password_hash')) ? Openssl\Argon2ID::class : PassHash\Argon2ID::class;

            case self::APACHE_APR1:
                return Apache\ApacheApr1BasicMd5::class;

            case self::APACHE_SHA1:
                return Apache\ApacheHashBasicSha1::class;

            case self::DIGEST_MD5:
                return Crypt\CryptMd5::class;

            case self::DIGEST_SHA256:
                return Crypt\CryptSha256::class;

            case self::DIGEST_SHA512:
                return Crypt\CryptSha512::class;

            case self::SALSA208_SHA256:
                return Sodium\Salsa208Sha256::class;
        }
        if (in_array($algo, hash_algos())) {
            return Hash\Digest::class;
        }
    }

    public function createByHash(#[\SensitiveParameter] string $hash): static
    {
        $this->instance = $this->_createByHash($hash);
        $this->hash = $hash;
        return $this;
    }

    protected function _createByHash(#[\SensitiveParameter] string $hash)
    {

        if (StringValidation::isValueStartingWith($hash, '{')) {
            //$hash_id = (new StringsManipulators($hash))->substringAfterChar('{')->substringBeforeChar('}');
            return Apache\ApacheHashBasicSha1::class;
        } elseif (StringValidation::isValueStartingWith($hash, self::APACHE_MD5)) {
            return Apache\ApacheHashDigestMd5::class;
        } elseif (StringValidation::isValueStartingWith($hash, '$')) {
            $hash_id = (new StringsManipulators($hash))->substringAfterChar('$')->substringBeforeChar('$');
            return $this->_createByAlgo((string) $hash_id);
        }

    }
}