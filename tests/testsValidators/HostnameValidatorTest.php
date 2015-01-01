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
