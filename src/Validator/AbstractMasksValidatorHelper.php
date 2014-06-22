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
 * The application validator model
 *
 * @author  Piero Wbmstr <me@e-piwi.fr>
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