<?php
/**
 * Application documentation builder
 *
 * See https://github.com/fabpot/Sami
 *
 * To build doc, run:
 *     $ php bin/sami.php render sami.config.php
 *
 * To update it, run:
 *     $ php bin/sami.php update sami.config.php
 *
 */

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->notName('SplClassLoader.php')
    ->in(__DIR__.'/src')
;

$options = array(
    'title'                => 'Validators',
    'build_dir'            => __DIR__.'/phpdoc',
    'cache_dir'            => __DIR__.'/../tmp/cache/validators',
    'default_opened_level' => 2,
);

return new Sami($iterator, $options);

// Endfile