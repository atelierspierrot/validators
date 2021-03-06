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

namespace Validator;

/**
 * IP address validator
 *
 * @author  piwi <me@e-piwi.fr>
 */
class InternetProtocolValidator
    extends AbstractMasksValidatorHelper
    implements ValidatorInterface
{

    /**
     * @var string  The version of the Internet Protocol to validate
     */
     protected $version='v4';

    /**
     * Constructor
     *
     * @param string $version
     */
    public function __construct($version=null)
    {
        $this->addMask('v4', '(?:[0-9]{1,3}\.){3}[0-9]{1,3}');
        $this->addMask('v4_full', '^' . $this->getMask('v4') . '$');

        $this->addMask('v6', '(((?=.*(::))(?!.*\3.+\3))\3?|([\dA-F]{1,4}(\3|:\b|$)|\2))(?4){5}((?4){2}|(((2[0-4]|1\d|[1-9])?\d|25[0-5])\.?\b){4})\z');
        $this->addMask('v6_full', '^' . $this->getMask('v6'));

        if (!is_null($version)) {
            $this->setVersion($version);
        }
    }

    /**
     * Set the version of the protocol to use
     *
     * @param   string  $version The version number of the protocol, must be a constructor's masks reference
     * @return  $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Process validation
     *
     * @param   string  $value          The local part of an email address to validate
     * @param   bool    $send_errors    Does the function must throw exceptions on validation failures ?
     * @return  bool    TRUE if `$value` pass the Email validation
     * @throws  \Exception for each invalid part if `$send_errors` is true
     */
    public function validate($value, $send_errors = false)
    {
        // the mask validation
        $full_mask = $this->getMask($this->version.'_full');
        $mask = $this->getMask($this->version);
        if (!strlen($mask)) {
            if (true===$send_errors) {
                throw new \Exception(
                    sprintf("No mask defined in InternetProtocol validator for version %s!", $this->version)
                );
            }
            return false;
        }

        // if we have a 'full' mask, we try it in priority
        $validator = new StringMaskValidator(
            strlen($full_mask) ? $full_mask : '^' . $mask . '$',
            'IP' . $this->version
        );

        // does $value pass the mask
        try {
            if (false===$ok = $validator->validate($value, false)) {
                if (true===$send_errors) {
                    throw new \Exception(
                        sprintf('String [%s] is not a valid InternetProtocol address in version %s', $value, $this->version)
                    );
                }
                return false;
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return true;
    }

    /**
     * Try to make $value pass the validation
     *
     * @param string $value
     * @return string
     */
    public function sanitize($value)
    {
        return $value;
    }
}



/*
//Valid IP v4
$ipv4_ok = array(
    '192.168.0.2',
    '127.0.0.1'
);
//Valid IP v6
$ipv6_ok = array(
    '2001:db8:1ff::a0b:dbd0',
);
//Invalid IP
$ip_notok = array(
    'example.com',
    '192.168.0.2.9876',
    '127.0.0.az',
    '127.0.az.1',
    '127.0.0az.1',
    '127.0.0.az.1',
    '2001:db8:::::a0b:dbd0',
);

$unit_test = CarteBlanche::getContainer()->get('unit_test');
$verbose = false;
//$verbose = true;

$v = new \Lib\Validator\InternetProtocolValidator();

$unit_test->newTestGroup( 
    'Strings that must pass validation of the "%s" class for version 4.',
    '\Lib\Validator\InternetProtocolValidator',
    'mlkj'
);
foreach( $ipv4_ok as $_str )
{
    $unit_test->assertTrue(
        $v->validate( $_str, $verbose ),
        sprintf("IPv4 validation on string [<em>%s</em>]", $_str)
    );
}

$v->setVersion('v6');
$unit_test->newTestGroup( 'Strings that must pass validation of the "%s" class for version 6.', '\Lib\Validator\InternetProtocolValidator' );
foreach( $ipv6_ok as $_str )
{
    $unit_test->assertTrue(
        $v->validate( $_str, $verbose ),
        sprintf("IPv6 validation on string [<em>%s</em>]", $_str)
    );
}

$v->setVersion('v4');
$unit_test->newTestGroup( 'Strings that must NOT pass validation of the "%s" class for version 4.', '\Lib\Validator\InternetProtocolValidator' );
foreach( $ip_notok as $_str )
{
    $unit_test->assertFalse(
        $v->validate( $_str, $verbose ),
        sprintf("IP validation on string [<em>%s</em>]", $_str)
    );
}

$v->setVersion('v6');
$unit_test->newTestGroup( 'Strings that must NOT pass validation of the "%s" class for version 6.', '\Lib\Validator\InternetProtocolValidator' );
foreach( $ip_notok as $_str )
{
    $unit_test->assertFalse(
        $v->validate( $_str, $verbose ),
        sprintf("IP validation on string [<em>%s</em>]", $_str)
    );
}

echo $unit_test;
*/
