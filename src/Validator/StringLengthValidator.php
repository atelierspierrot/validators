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
 * String length validator
 *
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 */
class StringLengthValidator
    extends AbstractMasksValidatorHelper
    implements ValidatorInterface
{

	/**
	 * A minimum string length
	 * By default, this value is setted on "0" so that an empty string can pass the validation
	 */
	protected $min_length=0;

	/**
	 * A maximum string length
	 * By default, this value is setted on "256" to comply with the common standards
	 */
	protected $max_length=256;

	/**
	 * Constructor : register usefull masks
	 *
	 * @param num $min The minimum length
	 * @param num $max The maximum length
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
	 * @param num $min The minimum length
	 */
	public function setMinLength($min)
	{
		$this->min_length = $min;
	}

	/**
	 * Set the maximum string length
	 * Maximum length + 1 will not pass the validation
	 *
	 * @param num $max The maximum length
	 */
	public function setMaxLength($max)
	{
		$this->max_length = $max;
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