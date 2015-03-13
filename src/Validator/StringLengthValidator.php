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

namespace Validator;

/**
 * String length validator
 *
 * @author  piwi <me@e-piwi.fr>
 */
class StringLengthValidator
    extends AbstractMasksValidatorHelper
    implements ValidatorInterface
{

    /**
     * @var int A minimum string length
     * By default, this value is set on "0" so that an empty string can pass the validation
     */
    protected $min_length=0;

    /**
     * @var int A maximum string length
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
        if (!is_null($min)) {
            $this->setMinLength( $min );
        }
        if (!is_null($max)) {
            $this->setMaxLength( $max );
        }
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
     *
     * @param string $value
     * @return string
     */
    public function sanitize($value)
    {
        return $value;
    }

}

// Endfile