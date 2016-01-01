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

class InternetProtocolValidatorTest extends \PHPUnit_Framework_TestCase
{

    //Valid IP v4
    public $ipv4_ok = array(
        '192.168.0.2',
        '127.0.0.1'
    );
    //Valid IP v6
    public $ipv6_ok = array(
        '2001:db8:1ff::a0b:dbd0',
    );
    //Invalid IP
    public $ip_notok = array(
        'example.com',
        '192.168.0.2.9876',
        '127.0.0.az',
        '127.0.az.1',
        '127.0.0az.1',
        '127.0.0.az.1',
        '2001:db8:::::a0b:dbd0',
    );

    public function testCreate()
    {
        $v = new \Validator\InternetProtocolValidator();

        // true v4
        foreach ($this->ipv4_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("IP v4 validation on string: %s", $_str)
            );
        }

        // false v4
        foreach ($this->ip_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("IP v4 validation on string: %s", $_str)
            );
        }

        // true v6
        $v->setVersion('v6');
        foreach ($this->ipv6_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("IP v6 validation on string: %s", $_str)
            );
        }

        // false v6
        $v->setVersion('v6');
        foreach ($this->ip_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("IP v6 validation on string: %s", $_str)
            );
        }
    }
}
