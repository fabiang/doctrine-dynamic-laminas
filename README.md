# fabiang/doctrine-dynamic-zf

Zend Framework 2/3 binding for [fabiang/doctrine-dynamic](https://github.com/fabiang/doctrine-dynamic).

[![Latest Stable Version](https://poser.pugx.org/fabiang/doctrine-dynamic-zf/version)](https://packagist.org/packages/fabiang/doctrine-dynamic-zf)
[![License](https://poser.pugx.org/fabiang/doctrine-dynamic-zf/license)](https://packagist.org/packages/fabiang/doctrine-dynamic-zf)
[![Dependency Status](https://gemnasium.com/badges/github.com/fabiang/doctrine-dynamic-zf.svg)](https://gemnasium.com/github.com/fabiang/doctrine-dynamic-zf)
[![Build Status](https://travis-ci.org/fabiang/doctrine-dynamic-zf.svg?branch=master)](https://travis-ci.org/fabiang/doctrine-dynamic-zf)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-zf/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-zf/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-zf/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/fabiang/doctrine-dynamic-zf/?branch=master)

## Requirements

This module works with Zend Framework 2 and 3, but
`zendframework/zend-servicemanager` must be at least at version 2.7.6.

Please see the [composer.json](composer.json) file for all other packages required.

## Installation

New to Composer? Read the [introduction](https://getcomposer.org/doc/00-intro.md#introduction). Run the following Composer command:

```console
$ composer require fabiang/doctrine-dynamic-zf
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
