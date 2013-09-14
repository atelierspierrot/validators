<?php
/**
 * PHP Validators
 * Copyleft (c) 2013 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <https://github.com/atelierspierrot/validators>
 */

require_once __DIR__.'/../src/SplClassLoader.php';
$classLoader = new SplClassLoader('Validator', __DIR__.'/../src');
$classLoader->register();
$classLoader_tests = new SplClassLoader('testsValidators', __DIR__.'/../tests');
$classLoader_tests->register();
