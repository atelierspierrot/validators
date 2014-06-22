<?php
/**
 * PHP Validators
 * Copyleft (c) 2013-2014 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <http://github.com/atelierspierrot/validators>
 */

namespace Validator;

/**
 * Email address validator
 *
 * @author  Piero Wbmstr <me@e-piwi.fr>
 */
class HostnameValidator
    extends AbstractMasksValidatorHelper
    implements ValidatorInterface
{

    /**
     * Which standard must the email pass ?
     * It is by default set on RFC1123 (more permissive)
     */
     protected $must_pass = 'RFC1123';

    /**
     * Constructor : register useful masks
     */
    public function __construct()
    {
        $this->addMask( 'AlphaDigit', '[A-Za-z0-9]' );
        $this->addMask( 'AlphaDigitHyphen', '[A-Za-z0-9-]' );
        $this->addMask( 'RFC952',
            '[^0-9-]' . $this->getMask('AlphaDigitHyphen') . '*[^-]'
        );
        $this->addMask( 'RFC1123',
            '[^-]' . $this->getMask('AlphaDigitHyphen') . '*[^-]'
        );
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

        // check for length compliance (max 255 chars.)
        $lengthValidator = new StringLengthValidator( 0, 255 );
        try {
            if (false===$length_valid = $lengthValidator->validate($value, false)) {
                if (true===$send_errors) {
                    throw new \Exception( sprintf('The hostname [%s] must not be up to 255 characters long!', $value) );
                }
                return false;
            }
        } catch (\Exception $e) { throw $e; }

        // check for double-dots
        if (false!==strpos($value, '..')) {
            if (true===$send_errors) {
                throw new \Exception( sprintf('The hostname [%s] must not contain double-dots!', $value) );
            }
            return false;
        }

        // check for each labels validity
        // => max length of 63 chars.
        $labelLengthValidator = new StringLengthValidator( 1, 63 );
        // => AlphaDigit compliance for a single char.
        $singlechar_labelMaskValidator = new StringMaskValidator(
            '^' . $this->getMask('AlphaDigit') . '$'
        );
        // => $this->must_pass compliance
        $labelMaskValidator = new StringMaskValidator(
            '^' . $this->getMask($this->must_pass) . '$', $this->must_pass
        );

        try {
            $labels = explode('.', $value);
            foreach ($labels as $_label) {
                if (strlen($_label) && false===$label_length_valid = $labelLengthValidator->validate($_label, false)) {
                    if (true===$send_errors) {
                        throw new \Exception(
                            sprintf('The label [%s] in the hostname [%s] must not be up to 63 characters long!', $_label, $value) );
                    }
                    return false;
                }

                if (strlen($_label)>1 && false===$label_mask_valid = $labelMaskValidator->validate($_label, $send_errors)) {
                    return false;
                }
                elseif (strlen($_label)==1 && false===$label_mask_valid = $singlechar_labelMaskValidator->validate($_label, false)) {
                    if (true===$send_errors) {
                        throw new \Exception(
                            sprintf('The single character label [%s] in the hostname [%s] must be an alpha-numeric string!', $_label, $value) );
                    }
                    return false;
                }

            }
        } catch (\Exception $e) { throw $e; }

        return true;
    }

    /**
     * Try to make $value pass the validation
     */
    public function sanitize($value)
    {
    }

    /**
     * Set the reference to use for validation
     */
    public function setMustPass($ref)
    {
        if (null!==$this->getMask($ref)) {
            $this->must_pass = $ref;
        } else {
            throw new \Exception( sprintf("Unknown standard [%s] in Hostname validation!", $ref) );
        }
    }

}

// Endfile

/*
//Valid hostnames
$hostnames_ok = array(
    'example.com',
    'www.des2.my-hostname.fr.co',
    'www.d.my-hostname.fr.co',
    '_smtp.google.com',
);

//Invalid hostnames
$hostnames_ko = array(
    '-hjk&example.com', // no hyphen first in a label
    'hjk&example-.com', // no hyphen last in a label
    '@hjk&example.com', // no special char.
    '..www.des2.my-hostname.fr.co', // no double-dots
    'www.-.my-hostname.fr.co', // no double-dots
    'azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop.com', // a label is too long
    // a hostname is too long
    'azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop.azertyuiop',
);

$unit_test = CarteBlanche::getContainer()->get('unit_test');
$verbose = false;
//$verbose = true;

$v = new \Lib\Validator\HostnameValidator();

$unit_test->newTestGroup( 
    'Strings that must pass validation of the "%s" class.',
    '\Lib\Validator\HostnameValidator'
);
foreach( $hostnames_ok as $_str )
{
    $unit_test->assertTrue(
        $v->validate( $_str, $verbose ),
        sprintf("Hostname validation on string [<em>%s</em>]", $_str)
    );
}

$unit_test->newTestGroup( 
    'Strings that must NOT pass validation of the "%s" class.',
    '\Lib\Validator\HostnameValidator'
);
foreach( $hostnames_ko as $_str )
{
    $unit_test->assertFalse(
        $v->validate( $_str, $verbose ),
        sprintf("Hostname validation on string [<em>%s</em>]", $_str)
    );
}

echo $unit_test;
*/