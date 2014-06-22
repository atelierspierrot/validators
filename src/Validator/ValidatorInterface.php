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
 * Validator interface
 *
 * Construction of a validator class
 *
 * @author  Piero Wbmstr <me@e-piwi.fr>
 */
interface ValidatorInterface
{

    /**
     * Process validation, must return a boolean
     *
     * @param   string  $value          The value to validate
     * @param   bool    $send_errors    Does the function must throw exceptions on validation failures ?
     * @return  bool    TRUE if `$value` passes the validation
     */
    public function validate($value, $send_errors = false);

    /**
     * Try to make `$value` pass the validation
     *
     * @param   mixed   $value
     * @return  mixed
     */
    public function sanitize($value);

}

// Endfile