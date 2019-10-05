# phpconsole
PHP console microframework based on https://github.com/wladweb/ServiceLocator
## Usage
```
cd /path/to/phpconsole
php -f index.php <controller> <action> <parameter1> <parameter2> ...
```
For shorter calling can add alias in *.bashrc* file. For example:
```
alias myapp='php -f /path/to/phpconsole/index.php'

```
And then calling it like:
```
myapp <controller> <action> <par1> ...
myapp index save some
```
## Controllers
All controllers must be named like **NameController**, placed in Controllers directory and extend AbstractController.
All action methods must be *public* and named like **nameAction**.
Command:
```
myapp index save some
```
create **IndexController**, call his method **saveAction** and pass there string "some" as parameter. 
Could skip all part of that command, except 'myapp'.
Skip action call indexAction, skip controller create IndexController and call indexAction.
## Config
config.php is config file of ServiceLocator. Here might define all stuff of your application. Any objects (like new Object or like FQN string), options, values, also there is application options like name, version and anything you want to add.

Controllers must be defined like:
```php
    'controller_index' => [
        'value' => '\Wladweb\Phpconsole\Controllers\IndexController'
    ],
    'controller_second' => [
        'value' => '\Wladweb\Phpconsole\Controllers\SecondController'
    ],
```
Index must be start with prefix 'controller_', field value must contain 'Fully\Qualified\Name'.
## Output
There is ability to output colored text in console by class Logger.
```php
        //by echo
        echo "It's indexAction from IndexController.", PHP_EOL;
        
        //or by Logger
        Logger::writeLine("It's indexAction from IndexController. Regular");
        
        //or custom colors @see Wladweb\Phpconsole\Utils\Colors
        Logger::writeLine("It's indexAction from IndexController. Custom", 'blue', 'black');
        
        //or predefined error
        Logger::writeBad("It's indexAction from IndexController. Error");
        
        //or predefined warning
        Logger::writeWarning("It's indexAction from IndexController. Warning");
        
        //or predefined good
        Logger::writeGood("It's indexAction from IndexController. Good");
        
        //or predefined info
        Logger::writeInfo("It's indexAction from IndexController. Info");
```
![git](https://user-images.githubusercontent.com/10974351/66260265-fb770b80-e7c4-11e9-8d7e-e20818a628e5.png)
