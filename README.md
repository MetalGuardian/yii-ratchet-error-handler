Ratchet Error Handler
==============

Error handler with handling php errors, exceptions,. fatal errors

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require metalguardian/yii-ratchet-error-handler "dev-master"
```

or add

```
"metalguardian/yii-ratchet-error-handler": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your configuration file :

```php
array(
    'preload' => array(
        // ...
        'rollbar',
        // ...
    ),
    'components' => array(
        'rollbar' => array(
            'class' => '\metalguardian\rollbar\Component',
            'access_token' => 'ACCESS_TOKEN',
            'environment' => 'production',
            'included_errno' => E_ALL,
        ),
        'errorHandler' => array(
            'class' => '\metalguardian\rollbar\ErrorHandler',
            'ignoreException' => function ($exception) {
                /** @var \CHttpException $exception */
                // ignore 404 exceptions
                if ($exception instanceof \CHttpException && $exception->statusCode == 404) {
                    return true;
                }
                // ignore 403 exceptions
                if ($exception instanceof \CHttpException && $exception->statusCode == 403) {
                    return true;
                }
                // other ignores

                return false;
            },
        ),

        ),
    // ...
)
```
