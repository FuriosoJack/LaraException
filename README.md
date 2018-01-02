# License

  El codigo de licencia debe seguirse al pie de la letra, si usted utiliza esta libreria los derechos de autor deben estar incluidos en todas la copias.
  
  Para mas informacion la puede encontra en el archivo LICENSE.txt.

  
# LaraException
Retorna excepciones de forma HTTP  JSON personalizada para laravel, en http redirecciona a una vista

## Installation 

```bash
$ composer require furiosojack/lara-exception
```

OR 

add to your `composer.json`

```json
{
    "require": {
        "furiosojack/lara-exception": "^0.0.1"
    }
}
```

Next, if using Laravel 5, include the service provider within your `config/app.php` file.

```php
'providers' => [
    FuriosoJack\LaraException\Providers\LaraExceptionServiceProvider::class,
];
```

Finally, add two class aliases to the aliases array of `config/app.php`:

```php
'aliases' => [
    'LaraException' => FuriosoJack\LaraException\Facades\LaraExceptionFacade::class,
  ],
```


## Examples

this generates a log in `storage/logs/laravel.log`

 ```php
 LaraException::buildEJson("hola mundo",500);

```

this does not generate a log in `storage/logs/laravel.logg`

 ```php
 LaraException::buildEJson("hola mundo",500,false);
```

```
result 

```json
{"error":"hola mundo","code":500}
```
