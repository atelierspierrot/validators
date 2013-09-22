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
 * Validator interface
 *
 * Construction of a validator class
 *
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 */
interface ValidatorInterface
{

	/**
	 * Process validation, must return a boolean
	 *
	 * @param string $value The value to validate
	 * @param bool $send_errors Does the function must throw exceptions on validation failures ?
	 *
	 * @return bool TRUE if $value pass the validation
	 */
	public function validate($value, $send_errors = false);

	/**
	 * Try to make $value pass the validation
	 *
	 * @param misc $value
	 *
	 * @return misc
	 */
	public function sanitize($value);

}

// Endfile