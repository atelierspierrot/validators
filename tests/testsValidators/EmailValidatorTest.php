<?php
/**
 * PHP Validators
 * Copyleft (c) 2013-2014 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <http://github.com/atelierspierrot/validators>
 */
namespace testsValidators;

class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{

    // http://en.wikipedia.org/wiki/Email_address

    //Valid email addresses
    public $str_ok = array(
        'user@[192.168.0.2]',
        'niceandsimple@example.com',
        'very.common@example.com',
        'a.little.lengthy.but.fine@dept.example.com',
        'disposable.style.email.with+symbol@example.com',
        'user@[IPv6:2001:db8:1ff::a0b:dbd0]',
    //  '0@a',
/*
        'postbox@com', // top-level domains are valid hostnames
        '!#$%&\'*+-/=?^_`{}|~@example.org',
        'much."more unusual"."thanever"@example.com',
        '"much.more unusual"@example.com',
        '"very.unusual.@.unusual.com"@example.com',
        '"very.(),:;<>[]\".VERY.\"very@\\ \"very\".unusual"@strange.example.com',
        '"()<>[]:,;@\\\"!#$%&\'*+-/=?^_\`{}| ~  ? ^_`{}|~.a"@example.org',
        '""@example.org'
*/
    );
    //Invalid email addresses
    public $str_notok = array(
    //  'Abc.example.com', // (an @ character must separate the local and domain parts)
    //  'Abc.@example.com', // (character dot(.) is last in local part)
    //  'Abc..123@example.com', // (character dot(.) is double)
    //  '-sdfqsdf@example.com', // (no hyphen first)
        'A@b@c@example.com', // (only one @ is allowed outside quotation marks)
        'a"b(c)d,e:f;g<h>i[j\k]l@example.com', // (none of the special characters in this local part is allowed outside quotation marks)
        'just"not"right@example.com', // (quoted strings must be dot separated, or the only element making up the local-part)
        'this is"not\allowed@example.com', // (spaces, quotes, and backslashes may only exist when within quoted strings and preceded by a backslash)
        'this\ still\"not\\allowed@example.com', // (even if escaped (preceded by a backslash), spaces, quotes, and backslashes must still be contained by quotes)
        // a label of the hostname is too long
        'azertyuiop@azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop.azertyuiop.azertyuiop.com',
        // hostname is too long
        'azertyuiop@azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop',
        'azertyuiopmlkjhgfdsqwxcvbnjhgfdsqazertyuiopmlkjhgfdsqwxcvbnjhgfds@example.com', // local part is too long
        'mlkjmlkjmlkj', // simple string
    );

    public function testCreate()
    {
        $v = new \Validator\EmailValidator();

        // true
        foreach($this->str_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("Email validation on string: %s", $_str)
            );
        }

        // false
        foreach($this->str_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("Email validation on string: %s", $_str)
            );
        }

    }
    
}
