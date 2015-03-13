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
 * The application validator model
 *
 * @author  piwi <me@e-piwi.fr>
 */
abstract class AbstractMasksValidatorHelper
{

    /**
     * @var array A set of masks to registered for validators use
     */
    protected $masks;

    /**
     * Register a new mask set
     *
     * @param   array $masks The mask table as name=>mask pairs
     * @return  self
     */
    public function setMasks($masks)
    {
        $this->masks = $masks;
        return $this;
    }

    /**
     * Register a new mask
     *
     * @param   string $mask_name The mask name to set
     * @param   string $mask The mask value to set
     * @return  self
     */
    public function addMask($mask_name, $mask)
    {
        $this->masks[$mask_name] = $mask;
        return $this;
    }

    /**
     * Get the masks registry
     *
     * @return array The masks array
     */
    public function getMasks()
    {
        return $this->masks;
    }

    /**
     * Get a registered mask
     *
     * @param   string $mask_name The name of the mask to get
     * @return  string The value registered for the mask name, an empty string if it has not been found
     */
    public function getMask($mask_name)
    {
        return isset($this->masks[$mask_name]) ? $this->masks[$mask_name] : '';
    }

}

// Endfile