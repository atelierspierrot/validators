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
 * String mask validator
 *
 * @author  piwi <me@e-piwi.fr>
 */
class StringMaskValidator
    implements ValidatorInterface
{

    /**
     * @var string The mask to test
     */
    protected $mask;

    /**
     * @var string The mask reference (an RFC reference for example)
     */
    protected $mask_reference;

    /**
     * @var string The PCRE options for validation (by default, case insensitive)
     */
    protected $pcre_options = 'i';

    /**
     * @var string The PCRE delimiter (by default a slash)
     */
    protected $pcre_delimiter = '/';

    /**
     * @var string PCRE quoting protection on mask
     */
    protected $preg_quote = false;

    /**
     * Constructor
     *
     * @param string    $mask   The mask to test
     * @param string    $ref    The mask reference
     * @param array     $options A set of options to set the object properties
     */
    public function __construct($mask = null, $ref = null, $options = array())
    {
        if (!is_null($mask)) {
            $this->setMask($mask);
        }
        if (!is_null($ref)) {
            $this->setMaskReference($ref);
        }
        foreach ($options as $_name=>$_value) {
            if (property_exists($this, $_name)) {
                $this->$_name = $_value;
            }
        }
        $this->_init();
    }

    /**
     * Internal initialization with specific options values
     */
    protected function _init()
    {
        if (true===$this->preg_quote) {
            $this->mask = preg_quote($this->mask);
        }
    }

    /**
     * Set the mask to test for values
     * The mask can be escaped by the 'preg_quote' function setting the second argument on TRUE.
     *
     * @param string $mask The mask to test in PCRE
     * @param bool $protect Do we have to protect the mask ?
     * @return object $this for method chaining
     */
    public function setMask($mask, $protect = null)
    {
        if (!is_null($protect)) {
            $this->setPregQuote($protect);
        }
        $this->mask = $mask;
        return $this;
    }

    /**
     * Set the mask reference
     *
     * @param string $ref The reference of the validation mask
     * @return object $this for method chaining
     */
    public function setMaskReference($ref)
    {
        $this->mask_reference = $ref;
        return $this;
    }

    /**
     * Set the PCRE options
     *
     * @param string $opts The options used for the PCRE mask construction
     * @return object $this for method chaining
     */
    public function setPcreOptions($opts)
    {
        $this->pcre_options = $opts;
        return $this;
    }

    /**
     * Set the PCRE delimiter
     *
     * @param string $delim The delimiter used for PCRE mask construction
     * @return object $this for method chaining
     */
    public function setPcreDelimiter($delim)
    {
        $this->pcre_delimiter = $delim;
        return $this;
    }

    /**
     * Set the protection on mask
     *
     * @param bool $protect The protection value to use 'preg_quote' protection on mask
     * @return object $this for method chaining
     */
    public function setPregQuote($protect)
    {
        $this->preg_quote = $protect;
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
        // have we got a mask ?
        if (empty($this->mask)) {
            if (true===$send_errors) {
                throw new \Exception(
                    $this->buildErrorString('No mask defined for StringMask validation', ' with reference [%s]')
                );
            }
            return false;
        }

        // does $value pass the mask
        if (0===preg_match($this->buildPcreMask(), $value)) {
            if (true===$send_errors) {
                throw new \Exception(
                    $this->buildErrorString('String [%s] is not valid', ' according to the [%s] reference', $value)
                );
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

    /**
     * Build an error string adding the mask reference if known
     *
     * @param   string $first The first parameter must be the global error string
     * @param   string $second The second parameter must be an alternative part of the error string, added if the mask reference is known
     * @param   mixed $others The rest of the parameters are taken and passed to the finale 'sprintf' function
     * @return  mixed
     */
    protected function buildErrorString()
    {
        $args = func_get_args();
        $error_str = array_shift($args);
        $ref_suffix = array_shift($args);

        if (!empty($this->mask_reference)) {
            array_push($args, $this->mask_reference);
            $error_str .= $ref_suffix;
        }

        array_unshift($args, $error_str);
        return call_user_func_array('sprintf', $args);
    }

    /**
     * Build the whole PCRE mask with the object settings
     *
     * @return string The mask to test on values
     */
    protected function buildPcreMask()
    {
        return $this->pcre_delimiter . $this->mask . $this->pcre_delimiter . $this->pcre_options;
    }
}
