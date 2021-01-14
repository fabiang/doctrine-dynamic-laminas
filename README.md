# fabiang/doctrine-dynamic-laminas

Laminas binding for [fabiang/doctrine-dynamic](https://github.com/fabiang/doctrine-dynamic).

[![Latest Stable Version](https://poser.pugx.org/fabiang/doctrine-dynamic-laminas/version)](https://packagist.org/packages/fabiang/doctrine-dynamic-laminas)
[![License](https://poser.pugx.org/fabiang/doctrine-dynamic-laminas/license)](https://packagist.org/packages/fabiang/doctrine-dynamic-laminas)
[![Build Status](https://travis-ci.com/fabiang/doctrine-dynamic-laminas.svg?branch=master)](https://travis-ci.com/fabiang/doctrine-dynamic-laminas)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-laminas/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-laminas/?branch=develop)
[![Code Coverage](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-laminas/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-laminas/?branch=develop)

## Installation

New to Composer? Read the [introduction](https://getcomposer.org/doc/00-intro.md#introduction). Run the following Composer command:

```console
$ composer require fabiang/doctrine-dynamic-laminas
```

## Configuration

Load the module by adding it to `config/application.config.php`:

```php
return [
    'modules' => [
        /** **/
        'Fabiang\DoctrineDynamic',
    ],
];
```

Configure extra options and associations into your module configuration (e.g. `config/module.config.php`):

```php
<?php

namespace Mymodule;

return [
    /** **/
    'doctrine_dynamic' => [
        \Mymodule\Entity\Customer::class => [
            'options' => [
                'repository' => \Mymodule\Repository\CustomerRepository::class,
            ],
            'fields' => [
                'fieldname' => [
                    'products' => [
                        'oneToMany' => [
                            [
                                'targetEntity' => \Mymodule\Entity\Customer::class,
                                'mappedBy'     => 'customer',
                            ]
                        ]
                    ]
                ]
            ]
        ],
        \Mymodule\Entity\Products::class => [
            'fields' => [
                'customer' => [
                    'manyToOne' => [
                        [
                            'targetEntity' => \Mymodule\Entity\Products::class,
                            'inversedBy'   => 'products',
                            'joinColumns'  => [
                                'name'                 => 'customer_id',
                                'referencedColumnName' => 'id'
                            ]
                        ]
                    ]
                ]
            ]
        ],
    ]
];
```

## Development

This library is tested with [PHPUnit](https://phpunit.de/).

Fork the project on Github and send an pull request with your changes.
Make sure you didn't break anything with running the following commands:

```console
composer install
./vendor/bin/phpunit
```

## License

BSD-2-Clause. See the [LICENSE.md](LICENSE.md).
