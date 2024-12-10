# Smarty  Template Engine for Codeigniter 4

Simple way to integrate Smarty template engine into Codeigniter 4
## Installation
Use the package manager [composer](https://getcomposer.org/) to install Smarty.
```bash
composer require asanusi007/ci4-smarty
```
## Usage
Open BaseController.php inside app/Controllers/BaseController.php and add this code

```php

use Asanusi007\Smarty\Traits\Viewable;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    use Viewable;

....

}
```
And then, you can use it like this:

```php
class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Home';
        return $this->parse('home', $data);
    }
}
```

## Configuration

You can change the default configuration by copy a file named `smarty.php` in the `Src/Config/` folder to `app/Config/Smarty.php`,  then you can change the configuration as you want.

```php
<?php

declare(strict_types=1);

namespace App\Config;

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

    // Where Smarty views are located
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


```

## Template Folder
By default, the template folder is `app/Views/` and the template file extension is `.tpl`.


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


for futher information, you can visit [Smarty Documentation](https://www.smarty.net/docs/en/)

## License
[MIT](https://choosealicense.com/licenses/mit/)
