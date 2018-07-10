# Español

## Licencia

  El codigo de licencia debe seguirse al pie de la letra, si usted utiliza esta libreria los derechos de autor deben estar incluidos en todas la copias.
    
  Para mas informacion la puede encontra en el archivo LICENSE.txt.

  
## Descripcion
Es un generador de excepciones, su  fin es lanzar excepciones controladas al usuario con la posibilidad de generar log detallados al desarollador.
 
El paquete es capaz de detectar una application/json de una peticion http por defecto. 

Este paquete entrega al usuario una vista en caso de ser http normal en donde se vera mensaje del error y un codigo de error, si la peticion es JSON el error sera devuelto en un resonse en formato JSON.

## Instalacion

Ejecutar en la consola dentro en la raiz del proyecto el comando: 
```bash
$ composer require furiosojack/lara-exception
```

o añadiendo directamente el el archivo `composer.json`


```json
{
    "require": {
        "furiosojack/lara-exception": "^0.0"
    }
}
```

Luego en el archivo `config/app.php` incluir el siguiente service provider

```php
'providers' => [
    FuriosoJack\LaraException\Providers\LaraExceptionServiceProvider::class,
];
```

y en el mismo archivo mas abajo la siguiente alianza 

```php
'aliases' => [
    'LaraException' => FuriosoJack\LaraException\Facades\LaraExceptionFacade::class,
  ],
```


para finalizar en su archivo `app/Exceptions/Handler.php` es necesario incluir la clase `LaraExceptionManager` en este archivo. Se puede hacer de la siguiente forma.

 
 ```php
 use FuriosoJack\LaraException\Exceptions\LaraExceptionManager;
 ```
 
 ahora la clase `Handler.php` en lugar de extender de `ExceptionHandler` debe extender es de  `LaraExceptionManager`  
quedando algo como esto:

```php
        
    namespace App\Exceptions;
    
    use Exception;
    use Illuminate\Auth\AuthenticationException;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use FuriosoJack\LaraException\Exceptions\LaraExceptionManager;
    class Handler extends LaraExceptionManager
    {
        
    
```


## Metodos

EL paquete provee unos parametros para ser la excepcion mas personalizada.

* **message(string)** - Este metodo recibe string que seria el mensaje que se va a mostrar en la excepcion **Obligatorio** **Siempre Visible**

  
* **debugCode(int)** -  Este metodo recibe un entero correpondiente al codigo de error de la excepcion (Util cuando se parametriza los errores). Si no se especifica el codigo de error por defecto sera 0. **Siempre Visible**


* **details(string)** - Este metodo recibe un string que corresponse al de talle del error, generalmente creado para dar mas detalles al programador, por defecto no se le puestra al usuario pero si se muestra en el log **Visible u Oculto**.


* **withLog()** - Este metodo no recibe ningun parametros. Es usado para indicar que se quiere generar un log por dicha excepcion.
    Los logs quedan almacenados dependiendo de como se tenga configurado en el proyecto, un proyecto donde no se le haya modificado el lugar de los log estos se almacenaran en `storage/logs/laravel.log`, si se especifican detalles y errores siempre seran mostrado en el log.  

* **showDetails()** - Este metodo permite que se muestre los detalles a la excepcion que se le muestra al usuario ya sea por HTTP norml o por JSON.

* **showErros()** - Muestra los errores en la respuesta si no se especifican errores se mostrara como null

* **errors([])** Recibe un array de los errores que se quieran ajuntas mas al error principal, estos errores solo son mostrados al usuario si se usan en conjunto con `showErrors`

* **style(string)** Recibe un string, permite especificar un estilo visual que corresponde a el `key` que tiene que estar declarado en `config/LaraException`. [(Leer Seccion)](#estilo-visual(view)) 

* **build(int = 200)** - *Este el utimo metodo que se debe llamar*. **Obligatorio** :bangbang: Este es el encargado de que la excepcion se lance, al metodo se le puede especificar el codigo `http de respuesta (HTTP STATUS CODE)`  por defecto si no se le especifica es `200`. 
## Ejemplos


 Lanza una excepcion con el mensaje indicado

 ```php
 \LaraException::message("hola mundo")->build();
```


Lanza una excepcion con un codigo de debugueo personalizado

 ```php
 \LaraException::message("hola mundo")->debugCode(15)->build();
```
 
 Lanza un excepcion con detalles y con debug code perzonalizado
 
 
 ```php
  \LaraException::message("hola mundo")
  ->debugCode(15)
  ->details("Ya dije hola mundo?")
  ->build();
 ```

Lanza un excepcion con detalles y con debug code perzonalizado y un log
 
 
 ```php
  \LaraException::message("hola mundo")
  ->debugCode(15)
  ->details("Ya dije hola mundo?")
  ->withLog()
  ->build();
 ```

Lanza un excepcion con detalles y con debug code perzonalizado y un log y muestra los detalles al usuario
 
 
 ```php
  \LaraException::message("hola mundo")
  ->debugCode(15)
  ->details("Ya dije hola mundo?")
  ->withLog()
  ->showDetails()
  ->showErrors()
  ->build();

```


En el siguiente ejemplo corresonde a la forma de enviar los errores en un array, solo funciona cuando la peticion tiene el header `Accept: applitacion/json`

 ```php
  \LaraException::message("hola mundo")
  ->debugCode(15)
  ->details("Ya dije hola mundo?")
  ->withLog()
  ->errors([
    "juan" => "nombre invalido",
    "petro" => "nombre no existe"
  ])
  ->showDetails()
  ->build();

```



Se puede hace varias combinaciones de los metodos ya que estan encadenados pero obiamente 
teniendoen cuenta que el metodo `build()` siempre sea el ultimo.

Tambien puede usar el helper en lugar de usar la fachada como se mosotro anteriormente, para usar el helper puede usar los mismos metodos ya mostrados, por ejemplo para relizar  

El primer parametro que recibira esta funcion sera el mensaje
 ```php
  lara_exception("hola mundo")
  ->debugCode(15)
  ->details("Ya dije hola mundo?")
  ->withLog()
  ->errors([
    "juan" => "nombre invalido",
    "petro" => "nombre no existe"
  ])
  ->showDetails()
  ->build();

```


## Salidas

En el caso de que la peticion sea JSON la respuesta se veria algo como:

```json
{
    "error": "hola mundo",
    "errors": {
        "juan": "nombre invalido",
        "petro": "nombre no existe"
    },
    "debugCode": 15,
    "details": "Ya dije hola mundo?",
    "success": false
}
```

Si es una peticion es http normal se le mostrara una vista

![ver](https://i.imgur.com/8QzdfEe.png)

Ejemplo de logs

![ver](https://i.imgur.com/CCLVxhE.png)



## Excepciones Personalizadas


### Estilo Visual(view)

***Solo es valido para excepciones que ocurran desde el navegador o que no sea una peticion JSON !!!!***

Si usted necesita que su proyecto o paquete pueda tener un estilo unico de excepciones tanto de vista o tenga unas caracteristicas especiales.

Es decir si por ejemplo usted esta programando un paquete para laravel y probablemente su paquete lo utilicen otras personas que tambien podrian estar utilizando LaraException y quiere que su paquete tenga un estilo visual(view) unico de excepciones.
O si esta programando un proyecto en Laravel y necesita un estilo visual(view) diferente al por defecto.

Para hacer eso posible es necesario que en la configuracion que tiene que estar en el proyecto en `config/LaraException.php`
debe crear un estilo con el siguiente formato:

```php
  'blog' => [
      'view' => 'blog.user.exceptions',
      'redirect' => true
  ]
```

Tenemos a **blog** como `key` queriendo decir que este estilo se llama blog, ahora dentro de este array
existen dos claves la `view` que represanta la vista que se mostrara cuando ocurra una excepcion.

La clave `redirect` representa si quiere que cuando ocurra una excepcion se redireccione a la url de LaraException (`/LaraException?errors=dsfdsfsdfsd`).

**PD:**
 
*Yo recomiendo dejarlo en `true` ya que esto permite que cuando un usuario haga una solicitud de tipo **POST** y se lance una exception esta se redireccion para que el usuario
no pueda dar F5 o recargar la pagina y evitar nuevamente un error.*  
   

Como ya usted tiene un estilo definido puede usar el LaraException de la siguiente manera

```php
lara_exception("mensaje")
->style('blog')
->details('detalles de la excepcion')
->build(500);
```

De esa forma cuando ocurra la excepcion la vista que se mostrara al usuario sera la que usted especifico en la configuracion.

SOnidos
/play tada

