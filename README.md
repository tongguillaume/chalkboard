# ChalkBoard

ChalkBoard is an library/script which can create XML and YAML translates files from folder (html, twig, blade)

## Installation

php: >=7.1


```bash
composer require chalkboard/chalkboard to install the library
```

## Usage

```php
use Chalkboard\Charkboard;

$traduction = new Chalkboard();

// path is the root folder of your project it will create the files in translates/
$traduction->createXMLandYAML($path);
```

```bash
php script.php
```


## ROAD MAP 

- Create some special class to translate only where we identify the class
- Create translates files with multiples language with api calls




## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)