<?php
/**
 * This file is part of the Validators package.
 *
 * Copyright (c) 2013-2015 Pierre Cassat <me@e-piwi.fr> and contributors
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
