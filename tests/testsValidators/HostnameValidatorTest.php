<?php
/**
 * PHP Validators
 * Copyleft (c) 2013-2014 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <http://github.com/atelierspierrot/validators>
 */
namespace testsValidators;

class HostnameValidatorTest extends \PHPUnit_Framework_TestCase
{

    public $str_ok = array(
        'example.com',
        'www.des2.my-hostname.fr.co',
        'www.d.my-hostname.fr.co',
        '_smtp.google.com',
    );

    public $str_notok = array(
        '-hjk&example.com', // no hyphen first in a label
        'hjk&example-.com', // no hyphen last in a label
        '@hjk&example.com', // no special char.
        '..www.des2.my-hostname.fr.co', // no double-dots
        'www.-.my-hostname.fr.co', // no double-dots
        'azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop.com', // a label is too long
        // a hostname is too long
        'azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop', 
    );

    public function testCreate()
    {
        $v = new \Validator\HostnameValidator();

        // true
        foreach($this->str_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("Hostname validation on string: %s", $_str)
            );
        }

        // false
        foreach($this->str_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("Hostname validation on string: %s", $_str)
            );
        }

    }
    
}
