<?php
/**
 * This file is part of the Validators package.
 *
 * Copyright (c) 2013-2016 Pierre Cassat <me@e-piwi.fr> and contributors
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * The source code of this package is available online at 
 * <http://github.com/atelierspierrot/validators>.
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
        foreach ($this->str_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("Email validation on string: %s", $_str)
            );
        }

        // false
        foreach ($this->str_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("Email validation on string: %s", $_str)
            );
        }
    }
}
