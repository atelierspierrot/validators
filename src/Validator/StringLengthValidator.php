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

namespace Validator;

/**
 * String length validator
 *
 * @author  Piero Wbmstr <me@e-piwi.fr>
 */
class StringLengthValidator
    extends AbstractMasksValidatorHelper
    implements ValidatorInterface
{

    /**
     * A minimum string length
     * By default, this value is set on "0" so that an empty string can pass the validation
     */
    protected $min_length=0;

    /**
     * A maximum string length
     * By default, this value is set on "256" to comply with the common standards
     */
    protected $max_length=256;

    /**
     * Constructor : register useful masks
     *
     * @param int $min The minimum length
     * @param int $max The maximum length
     */
    public function __construct($min = null, $max = null)
    {
        if (!is_null($min)) $this->setMinLength( $min );
        if (!is_null($max)) $this->setMaxLength( $max );
    }

    /**
     * Set the minimum string length
     * Minimum length - 1 will not pass the validation
     *
     * @param int $min The minimum length
     */
    public function setMinLength($min)
    {
        $this->min_length = $min;
    }

    /**
     * Set the maximum string length
     * Maximum length + 1 will not pass the validation
     *
     * @param int $max The maximum length
     */
    public function setMaxLength($max)
    {
        $this->max_length = $max;
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
        $_length = strlen($value);

        if ($_length<$this->min_length) {
            if (true===$send_errors) {
                throw new \Exception( sprintf('The string [%s] must be at least %d character(s) long!', $value, $this->min_length) );
            }
            return false;
        }

        if ($_length>$this->max_length) {
            if (true===$send_errors) {
                throw new \Exception( sprintf('The string [%s] must not be more than %d characters long!', $value, $this->max_length) );
            }
            return false;
        }

        return true;
    }

    /**
     * Try to make $value pass the validation
     */
    public function sanitize($value)
    {
    }

}

// Endfile