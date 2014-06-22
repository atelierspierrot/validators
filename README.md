Validators
==========

A PHP validators package to test RFC's compliance.


## Usage

All validators must implement the `\Validator\ValidatorInterface` which defines two methods:

-   `validate( thing )` which must return a boolean value indicating if `thing` passes the
    validation test
-   `sanitize( thing )` which must return a sanitized version of `thing` that must pass the
    validation test

Example usage of the `\Validator\EmailValidator` (use the same process for each validator):

    $thing = 'my.address@email.com';

    $v = new \Validator\EmailValidator();
    if ($v->validate($thing)) {
        // $thing is OK ...

    } else {
        // $thing is KO ...

        $new_thing = $v->sanitize($thing);
        // $new_thing must be OK ...
    }


## Installation

You can use this package in your work in many ways.

First, you can clone the [GitHub](https://github.com/atelierspierrot/validators) repository
and include it "as is" in your poject:

    https://github.com/atelierspierrot/validators

You can also download an [archive](https://github.com/atelierspierrot/validators/downloads)
from Github.

Then, to use the package classes, you just need to register the `Validator` namespace directory
using the [SplClassLoader](https://gist.github.com/jwage/221634) or any other custom autoloader:

    require_once '.../src/SplClassLoader.php'; // if required, a copy is proposed in the package
    $classLoader = new SplClassLoader('Validator', '/path/to/package/src');
    $classLoader->register();

If you are a [Composer](http://getcomposer.org/) user, just add the package to your requirements
in your `composer.json`:

    "require": {
        ...
        "atelierspierrot/validators": "dev-master"
    }


## Development

To install all PHP packages for development, just run:

    ~$ composer install --dev

A documentation can be generated with [Sami](https://github.com/fabpot/Sami) running:

    ~$ php vendor/sami/sami/sami.php render sami.config.php

The latest version of this documentation is available online at <http://docs.ateliers-pierrot.fr/validators/>.

A set of [PHP Unit](http://phpunit.de/manual/current/en/index.html) tests can be run running:

    ~$ php vendor/phpunit/phpunit/phpunit.php


## Author & License

>    Validators

>    http://github.com/atelierspierrot/validators

>    Copyleft 2013-2014, Pierre Cassat and contributors

>    Licensed under the GPL Version 3 license.

>    http://opensource.org/licenses/GPL-3.0

>    ----

>    Les Ateliers Pierrot - Paris, France

>    <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>

