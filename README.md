Ratchet Error Handler
==============

Error handler with handling php errors, exceptions,. fatal errors

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist metalguardian/yii-ratchet-error-handler "*"
```

or add

```
"metalguardian/yii-ratchet-error-handler": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your configuration file :

```php
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
        ),
    // ...
]
```
