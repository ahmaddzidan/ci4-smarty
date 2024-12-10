<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Asanusi007\Smarty\Config;

use Asanusi007\Smarty\Smarty;
use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    /**
     * SmartyEngine
     *
     * Smarty Services
     *
     * @param bool $getShared Shared instance
     *
     * @return object
     */
    public static function SmartyEngine($getShared = true)
    {
        return $getShared === true ? static::getSharedInstance('SmartyEngine') : new Smarty();
    }
}
