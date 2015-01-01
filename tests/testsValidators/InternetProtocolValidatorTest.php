<?php
/**
 * PHP Validators
 * Copyleft (ↄ) 2013-2015 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <http://github.com/atelierspierrot/validators>
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
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
        foreach($this->ipv4_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("IP v4 validation on string: %s", $_str)
            );
        }

        // false v4
        foreach($this->ip_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("IP v4 validation on string: %s", $_str)
            );
        }

        // true v6
        $v->setVersion('v6');
        foreach($this->ipv6_ok as $_str) {
            $this->assertTrue(
                $v->validate($_str),
                sprintf("IP v6 validation on string: %s", $_str)
            );
        }

        // false v6
        $v->setVersion('v6');
        foreach($this->ip_notok as $_str) {
            $this->assertFalse(
                $v->validate($_str),
                sprintf("IP v6 validation on string: %s", $_str)
            );
        }

    }
    
}
