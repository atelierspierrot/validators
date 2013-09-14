<?php
/**
 * PHP Validators
 * Copyleft (c) 2013 Pierre Cassat and contributors
 * <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
 * License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
 * Sources <https://github.com/atelierspierrot/validators>
 */

namespace Validator;

/**
 * String mask validator
 *
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 */
class StringMaskValidator
    implements ValidatorInterface
{

	/**
	 * The mask to test
	 */
	protected $mask;

	/**
	 * The mask reference (an RFC reference for example)
	 */
	protected $mask_reference;

	/**
	 * The PCRE options for validation (by default, case insensitive)
	 */
	protected $pcre_options = 'i';

	/**
	 * The PCRE delimiter (by default a slash)
	 */
	protected $pcre_delimiter = '/';

	/**
	 * PCRE quoting protection on mask
	 */
	protected $preg_quote = false;

	/**
	 * Constructor
	 *
	 * @param str $mask The mask to test
	 * @param str $ref The mask reference
	 * @param array $options A set of options to set the object properties
	 */
	public function __construct($mask = null, $ref = null, $options = array())
	{
		if (!is_null($mask)) $this->setMask($mask);
		if (!is_null($ref)) $this->setMaskReference($ref);
		foreach($options as $_name=>$_value) {
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
		} else {
			$this->mask = $this->mask;
		}
	}

	/**
	 * Set the mask to test for values
	 * The mask can be escaped by the 'preg_quote' function setting the second argument on TRUE.
	 *
	 * @param str $mask The mask to test in PCRE
	 * @param bool $protect Do we have to protect the mask ?
	 * @return object $this for method chaining
	 */
	public function setMask($mask, $protect = null)
	{
		if (!is_null($protect)) {
			$this->setPregQuote( $protect );
		}
		$this->mask = $mask;
		return $this;
	}

	/**
	 * Set the mask reference
	 *
	 * @param str $ref The reference of the validation mask
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
	 * @param str $opts The options used for the PCRE mask construction
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
	 * @param str $delim The delimiter used for PCRE mask construction
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
	 * @param string $value The string to validate
	 * @param bool $send_errors Does the function must throw exceptions on validation failures ?
	 * @return bool TRUE if $value pass the length validation
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
	 */
	public function sanitize($value)
	{
	}

	/**
	 * Build an error string adding the mask reference if known
	 * 
	 * @param string $first The first parameter must be the global error string
	 * @param string $second The second parameter must be an alternative part of the error string, added if the mask reference is known
	 * @param misc $others The rest of the parameters are taken and passed to the finale 'sprintf' function
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

// Endfile