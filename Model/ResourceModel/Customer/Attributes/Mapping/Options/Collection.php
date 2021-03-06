<?php
/**
 * BitTools Platform | B2W - Companhia Digital
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @category  BitTools
 * @package   BitTools_SkyHub
 *
 * @copyright Copyright (c) 2018 B2W Digital - BitTools Platform.
 *
 * @author    Julio Reis <julio.reis@b2wdigital.com>
 */

namespace BitTools\SkyHub\Model\ResourceModel\Customer\Attributes\Mapping\Options;

use BitTools\SkyHub\Model\Customer\Attributes\Mapping\Options;
use BitTools\SkyHub\Model\ResourceModel\Customer\Attributes\Mapping\Options as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Options::class, ResourceModel::class);
    }
}
