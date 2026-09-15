# Password-Hashing

## Description

This library provides an abstraction layer in order to hash and verify given client passwords using some crypt and password hashing functions, in order to unify the creation and validation implementing interfaces

## Install

```bash
composer require juanchosl/password-hashing
```

## How use it

For use, we allways are starting with a plain given password, sended by the user. Using this plain text, we need to creates an instance of our used object to saved the hashed passwords

### Hash a plain password

To hash a given password, we only needs cast to string the plain given password, and save the hash to into our database

```php
$hasher = new ArgonI($sended_password);
$hash = (string) $hasher;
```

### Verify a given password

When an user needs to login, we creates an instance with the given password after verify that the user exists and is enabled. Then only needs invoke the object with the prior saved hash in order to verify that it has been created with the same password, and returning a boolean indicating the verification.

```php
$hasher = new ArgonID($sended_password);
$validate = $hasher($database_hash);
```

### Extra parameters

Some modules, have a extra parameters in order to hash the passwords, has number of iterations, a salt to ensure the security, or a list of algorithms to use

| Module    | Algorithm | Salt  | Iterations | Length |
| Password  |           |   X   |            |        |
| Hash      |     X     |       |            |        |
| Hmac      |           |       |            |        |
| Crypt MD5 |           |   X   |            |        |
| Crypt std |           |   X   |            |        |
| Crypt     |           |   X   |     X      |        |
| Apache APR|           |   X   |            |        |