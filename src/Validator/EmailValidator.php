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
 * Email validator
 *
 * @author  piwi <me@e-piwi.fr>
 */
class EmailValidator
    extends AbstractMasksValidatorHelper
    implements ValidatorInterface
{

    /**
     * @var string Which standard must the email pass ?
     * It is by default set on RFC2822 as the RFC5322 mask is not fully functional
     */
     protected $must_pass = 'RFC2822';

    /**
     * @var array Defined standards list
     * They are indexed to pass them in that order
     */
     public static $standards_list = array(
        0=>'RFC952',
        1=>'RFC2822',
        2=>'RFC5322'
     );

    /**
     * Constructor : register useful masks
     */
    public function __construct()
    {
        $this->addMask('RFC952',
            '[^0-9-](.*)[^-]'
        );

        $this->addMask(
            'RFC2822',
//            '[a-z0-9\.\!#\$%&\'\*\+\/\=\?\^_`\{\|\}~\-]+'
            '[a-z0-9\.\!#\$%&\'\*\+\-\/\=\?\^_`\{\|\}~]+'
        );

        // !! this mask is not really functional
        $this->addMask(
            'RFC5322',
//            '[^0-9-][a-z0-9!#\$%&\'\*\+\/=\.\?\^_`\{\|\}~\-]+[^-]'
//            '(?:(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")'
            '(?:(?:\.[a-z0-9!#\$%&\'\*\+\/\=\?\^_`\{\|\}~\-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")'
//            '"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*"'
        );
    }

    /**
     * Process validation
     *
     * @param   string  $value          The email address to validate
     * @param   bool    $send_errors    Does the function must throw exceptions on validation failures ?
     * @return  bool    TRUE if $value pass the Email validation
     * @throws  \Exception if the email address does not contain an "at" sign ("@")
     */
    public function validate($value, $send_errors = false)
    {
        // value contains @ ?
        $atIndex = strrpos($value, "@");
        if (false===$atIndex) {
            if (true===$send_errors) {
                throw new \Exception(sprintf('The email address [%s] does not contain at-sign!', $value));
            }
            return false;
        }

        // local part validation
        $local_part = substr($value, 0, $atIndex);
        if (false===$this->validateLocalPart($local_part, $send_errors)) {
            return false;
        }

        // domain part validation
        $domain_part = substr($value, $atIndex+1);
        if (false===$this->validateDomainPart($domain_part, $send_errors)) {
            return false;
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

    /**
     * Process local part validation
     *
     * @param   string  $value          The local part of an email address to validate
     * @param   bool    $send_errors    Does the function must throw exceptions on validation failures ?
     * @return  bool    TRUE if `$value` pass the Email validation
     * @throws  \Exception for each invalid part if `$send_errors` is true
     */
    public function validateLocalPart($value, $send_errors=false)
    {
        // check for local part length compliance (max 64 chars.)
        $lengthValidator = new StringLengthValidator(0, 64);
        try {
            if (false===$local_length_valid = $lengthValidator->validate($value, false)) {
                if (true===$send_errors) {
                    throw new \Exception(sprintf('The local part of the email address [%s] must not be up to 64 characters!', $value));
                }
                return false;
            }
        } catch (\Exception $e) {
            throw $e;
        }

        // check for dots in local part
        // => not the first character
        if (substr($value, 0, 1)=='.') {
            if (true===$send_errors) {
                throw new \Exception(sprintf('The local part of the email address [%s] must not begin with a dot!', $value));
            }
            return false;
        }
        // => not the last character
        if (substr($value, -1, 1)=='.') {
            if (true===$send_errors) {
                throw new \Exception(sprintf('The local part of the email address [%s] must not end with a dot!', $value));
            }
            return false;
        }
        // => no double-dots
        if (false!==strpos($value, '..')) {
            if (true===$send_errors) {
                throw new \Exception(sprintf('The local part of the email address [%s] must not contain double-dots!', $value));
            }
            return false;
        }

        // the local part must match the standards as wanted
        $last=0;
        foreach (self::$standards_list as $standard) {
            if (1===$last) {
                continue;
            }
            if ($standard==$this->must_pass) {
                $last=1;
            }

            $maskValidator = new StringMaskValidator(
                '^' . $this->getMask($standard) . '$', $standard
            );
            try {
                if (false===$local_part_mask_valid = $maskValidator->validate($value, $send_errors)) {
                    return false;
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }

        return true;
    }

    /**
     * Process domain part validation
     *
     * @param   string  $value The domain part of an email address to validate
     * @param   bool    $send_errors Does the function must throw exceptions on validation failures ?
     * @return  bool    TRUE if $value pass the Email validation
     * @throws  \Exception for each invalid part if `$send_errors` is true
     */
    public function validateDomainPart($value, $send_errors = false)
    {
        // the domain name must be an IP address between brackets ...
        if (
            substr($value, 0, 1)=='[' &&
            substr($value, -1, 1)==']'
        ) {
            $ip_domain_part = substr($value, 1, strlen($value)-2);
            // is it an IPv6
            if (substr($ip_domain_part, 0, strlen('IPv6:'))=='IPv6:') {
                $ip6_domain_part = substr($ip_domain_part, strlen('IPv6:'));
                $ip6HostnameValidator = new InternetProtocolValidator('v6');
                try {
                    if (false===$ip6domain_name_valid = $ip6HostnameValidator->validate($ip6_domain_part, $send_errors)) {
                        return false;
                    }
                } catch (\Exception $e) {
                    throw $e;
                }
            }
            // otherwise IPv4
            else {
                $ip4HostnameValidator = new InternetProtocolValidator;
                try {
                    if (false===$ip4domain_name_valid = $ip4HostnameValidator->validate($ip_domain_part, $send_errors)) {
                        return false;
                    }
                } catch (\Exception $e) {
                    throw $e;
                }
            }
        }
        // ... or a valid hostname
        else {
            $hostnameValidator = new HostnameValidator;
            try {
                if (false===$hostdomain_name_valid = $hostnameValidator->validate($value, $send_errors)) {
                    return false;
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }

        return true;
    }

    /**
     * Defines the RFC to validate
     *
     * @param   string  $ref
     * @throws  \Exception if the `$ref` is not a known RFC
     */
    public function setMustPass($ref)
    {
        if (null!==$this->getMask($ref)) {
            $this->must_pass = $ref;
        } else {
            throw new \Exception(sprintf("Unknown standard [%s] in Email validation!", $ref));
        }
    }
}



/*
// http://en.wikipedia.org/wiki/Email_address

//Valid email addresses
$str_ok = array(
    'user@[192.168.0.2]',
    'niceandsimple@example.com',
    'very.common@example.com',
    'a.little.lengthy.but.fine@dept.example.com',
    'disposable.style.email.with+symbol@example.com',
    'user@[IPv6:2001:db8:1ff::a0b:dbd0]',
//    '0@a',
    'postbox@com', // top-level domains are valid hostnames
    '!#$%&\'*+-/=?^_`{}|~@example.org',
    'much."more unusual"."thanever"@example.com',
    '"much.more unusual"@example.com',
    '"very.unusual.@.unusual.com"@example.com',
    '"very.(),:;<>[]\".VERY.\"very@\\ \"very\".unusual"@strange.example.com',
    '"()<>[]:,;@\\\"!#$%&\'*+-/=?^_\`{}| ~  ? ^_`{}|~.a"@example.org',
    '""@example.org'
);
//Invalid email addresses
$str_notok = array(
    'Abc.example.com', // (an @ character must separate the local and domain parts)
    'Abc.@example.com', // (character dot(.) is last in local part)
    'Abc..123@example.com', // (character dot(.) is double)
    '-sdfqsdf@example.com', // (no hyphen first)
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

$unit_test = CarteBlanche::getContainer()->get('unit_test');
$verbose = false;
//$verbose = true;

$v = new \Lib\Validator\EmailValidator();

$unit_test->newTestGroup( 'Email addresses that must pass the validation of the "%s" class.', '\Lib\Validator\EmailValidator' );
foreach( $str_ok as $_str )
{
    $unit_test->assertTrue(
        $v->validate( $_str, $verbose ),
        sprintf("Email validation on string [<em>%s</em>]", $_str)
    );
}

$unit_test->newTestGroup( 'Email addresses that must NOT pass the validation from the "%s" class.', '\Lib\Validator\EmailValidator' );
foreach( $str_notok as $_str )
{
    $unit_test->assertFalse(
        $v->validate( $_str, $verbose ),
        sprintf("Email validation on string [<em>%s</em>]", $_str)
    );
}

echo $unit_test;

*/
