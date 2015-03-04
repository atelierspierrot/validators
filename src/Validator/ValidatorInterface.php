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