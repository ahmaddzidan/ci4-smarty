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

## Template Folder
By default, the template folder is `app/Views/` and the template file extension is `.tpl`.


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


for futher information, you can visit [Smarty Documentation](https://www.smarty.net/docs/en/)

## License
[MIT](https://choosealicense.com/licenses/mit/)
