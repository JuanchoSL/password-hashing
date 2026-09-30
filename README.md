# Password-Hashing

## Description

This library provides an abstraction layer in order to hash and verify given client passwords using some crypt and password hashing functions, in order to unify the creation and validation implementing interfaces

## Install

```bash
composer require juanchosl/password-hashing
```

## Available hashings

- BCrypt, Argon2I, Argon2ID using [Password hashing](https://www.php.net/manual/en/function.password-hash.php)
- [Salsa208](https://www.php.net/manual/es/function.sodium-crypto-pwhash-scryptsalsa208sha256-str.php), [Argon2ID](https://www.php.net/manual/es/function.sodium-crypto-pwhash-str.php) using [Sodium](https://www.php.net/manual/es/book.sodium.php) module
- MD5, DES (standard and extended), Blowfish, SHA256, SHA512 using [Crypt](https://www.php.net/manual/en/function.crypt.php)
- Digest created with any _hash algorithm_ included into [hash_algos()](https://www.php.net/manual/en/function.hash-algos.php) function: [Hash](https://www.php.net/manual/en/function.hash.php)
- PBKDF2 derivation created with any _hash hmac algorithm_ included into [hash_hmac_algos()](https://www.php.net/manual/en/function.hash-hmac-algos.php) function: [hash_pbkdf2](https://www.php.net/manual/en/function.hash-pbkdf2.php)
- Sha1 (Apache Sha1), the apache implementation for his authentication module on [Basic authentication](https://httpd.apache.org/docs/trunk/es/misc/password_encryptions.html#basic) > BASE64 of SHA1 binary password digest, with a prepenned _{SHA}_ string
- APR1 (Apache MD5), an owned algorithm for his authentication module on [Basic authentication](https://httpd.apache.org/docs/trunk/es/misc/password_encryptions.html#basic) > always 1000 iterations over a random salt
- Apache Digest MD5, the apache implementation for his authentication module on [Digest authentication](https://httpd.apache.org/docs/trunk/es/misc/password_encryptions.html#digest)

## How use it

For use, we allways are starting with a plain given password, sended by the user. Using this plain text, we need to creates an instance of our used object to saved the hashed passwords

### Direct Module

#### Hash a plain password

To hash a given password, we only needs cast to string the plain given password, and save the hash to into our database

```php
$hasher = new Argon2I($sended_password);
$hash = (string) $hasher;
```

#### Verify a given password

When an user needs to login, we creates an instance with the given password after verify that the user exists and is enabled. Then only needs to invoke the previously created object, with the prior saved hash extracted from database as parameter, in order to verify that it has been created with the same password, and returning a boolean indicating the verification result.

```php
$database_hash = (new UserDatabase)->select("password")->where("username", $passed_username, '=')->hashed_password;

$hasher = new Argon2ID($sended_password);
$validation_result = $hasher($database_hash);//true or false
```

### Factory

Using the provided Factory, we can use few algorithms into a same project.

#### Hash a plain password

In order to hash a plain given password, we can create an instance with a desired algorithm using the available constants (not all the modules are availables into factory due does not an indicator), the factory save internally the detected module, using it for create an instance when we invoke the factory with the password. Then, we have the object stringable, as using the direct module selection.

```php
$selection = (new ModuleFactory)->createByAlgo(ModuleFactory::BLOWFISH);
$hash = (string) $selection($plain_password);
```

#### Verify a given password

Having a previously created hash, we can use it in order to create a module instance with the ModuleFactory and the createByHash function. When we are invoking the factory object with a given password, the factory do the Module work, detects the module using the hash algorithm, creates the instance with the password, and do the hash verification, returnig the results instead a prepared object.

```php
$selection = (new ModuleFactory)->createByHash('$apr1$0R.8169N$aamu1e59aLzV7B6u4unAK.');
$result = $selection($plain_password);
```

### Extra parameters

Some modules, have a extra parameters in order to hash the passwords, has number of iterations, a salt to ensure the security, or a list of algorithms to use

| Module     | Algorithm | Salt | Iterations |Mem cost KB | Length | Output |
| :--------- | :-------: | :--: | :--------: | :--------: | :----: | :----: |
| Pass ARG2  |           |      |     X      |      X     |        | BASE64 |
| Pass BCRYP |           |  X   |            |            |        | BASE64 |
| Hash       |     X     |      |            |            |        | HEXDEC |
| Hmac Pbkdf |     X     |  X   |            |            |    X   | HEXDEC |
| Hmac Hkdf  |     X     |  X   |            |            |    X   | HEXDEC |
| Crypt MD5  |           |  X   |            |            |        | BASE64 |
| Crypt std  |           |  X   |            |            |        | BASE64 |
| Crypt      |           |  X   |     X      |            |        | BASE64 |
| Apache APR |           |  X   |            |            |        | BASE64 |
| Apache SHA |           |      |            |            |        | BASE64 |
| Apache MD5 |           |      |            |            |        | HEXDEC |
| Sodium     |           |      |     X      |      X     |        | BASE64 |
| OpenSSL    |           |      |            |            |        | BASE64 |

### Compatibility

The algorithms are duplicated across some modules, each one have his plus, but it are compatibles and can inter-operate.

**Argon2I** and **Argon2ID** hashes, can be generated or validated using _Password hashing_ (the recomended option), and _Sodium_ (better performance), that is provided with PHP since v 7.2.0, but maybe needs to be enabled. _OpenSSL_ can be used too as the backend, offering hardware acceleration, but only since OpenSSL v3.2+ and PHP v>=8.4

**Blowfish** can be generated or validated using _Password hashing_ (the recomended option), and _Crypt_ (more options to config).

**Apache SHA1** and the **SHA1 Digest**, have the same results in distinct format, Apache needs to start the hash with a _{SHA}_ keyword in order to save into _.htpasswd_ file as base64 encode and digest is generated with his hexadecimal representation.

**Apache MD5 Digest** is compatible with the standard **MD5 Digest**, but not with **Crypt MD5** (starts with a \$1\$ string, and the result is limited to 13 characters). **Apache APR1 MD5** is a special implementation with an owned Apache algorithm
