Validators
==========

[![Build Status](https://travis-ci.org/atelierspierrot/validators.svg?branch=master)](https://travis-ci.org/atelierspierrot/validators)
[![documentation](http://img.ateliers-pierrot-static.fr/read-the-doc.svg)](http://docs.ateliers-pierrot.fr/validators/)
A PHP validators package to test RFC's compliance.


Usage
-----

All validators must implement the `\Validator\ValidatorInterface` which defines two methods:

-   `validate( thing )` which must return a boolean value indicating if `thing` passes the
    validation test
-   `sanitize( thing )` which must return a sanitized version of `thing` that must pass the
    validation test

Example usage of the `\Validator\EmailValidator` (use the same process for each validator):

```php
$thing = 'my.address@email.com';

$v = new \Validator\EmailValidator();
if ($v->validate($thing)) {
    // $thing is OK ...

} else {
    // $thing is KO ...

    $new_thing = $v->sanitize($thing);
    // $new_thing must be OK ...
}
```


Installation
------------

For a complete information about how to install this package and load its namespace, 
please have a look at [our *USAGE* documentation](http://github.com/atelierspierrot/atelierspierrot/blob/master/USAGE.md).

If you are a [Composer](http://getcomposer.org/) user, just add the package to the 
requirements of your project's `composer.json` manifest file:

```json
"atelierspierrot/validators": "@stable"
```

You can use a specific release or the latest release of a major version using the appropriate
[version constraint](http://getcomposer.org/doc/01-basic-usage.md#package-versions).


Author & License
----------------

>    Validators

>    http://github.com/atelierspierrot/validators

>    Copyright (c) 2013-2016 Pierre Cassat and contributors

>    Licensed under the Apache 2.0 license.

>    http://www.apache.org/licenses/LICENSE-2.0

>    ----

>    Les Ateliers Pierrot - Paris, France

>    <http://www.ateliers-pierrot.fr/> - <contact@ateliers-pierrot.fr>

