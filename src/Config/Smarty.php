<?php

declare(strict_types=1);

namespace Asanusi007\Smarty\Config;

use CodeIgniter\Config\BaseConfig;

class Smarty extends BaseConfig
{
    // Smarty caching enabled by default unless explicitly set to FALSE
    public $cache_status = false;

    // Cache lifetime. Default value is 3600 seconds (1 hour) Smarty's default value
    public $cache_lifetime = -1;

    // Where templates are compiled
    public $compile_directory = WRITEPATH . 'cache/smarty/compiled/';

    // Where templates are cached
    public $cache_directory = WRITEPATH . 'cache/smarty/cached/';

    // Where Smarty configs are located
    public $config_directory = APPPATH . 'third_party/Smarty/configs/';

    // Where Smarty configs are located
    public $template_directory = [
        APPPATH . 'Views/',
        APPPATH . 'Views/admin/',
        APPPATH . 'Views/website/',
    ];

    // Default extension of templates if one isn't supplied
    public $template_ext = 'tpl';

    // Error reporting level to use while processing templates
    public $template_error_reporting = E_ALL & ~E_NOTICE;

    // Debug mode turned on or off (TRUE / FALSE)
    public $smarty_debug     = false;
    public $smarty_modifiers = [];
}
