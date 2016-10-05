# fabiang/doctrine-dynamic-zf

Zend Framework 2/3 binding for [fabiang/doctrine-dynamic](https://github.com/fabiang/doctrine-dynamic).

[![Latest Stable Version](https://poser.pugx.org/fabiang/doctrine-dynamic-zf/version)](https://packagist.org/packages/fabiang/doctrine-dynamic-zf)
[![License](https://poser.pugx.org/fabiang/doctrine-dynamic-zf/license)](https://packagist.org/packages/fabiang/doctrine-dynamic-zf)

## Requirements

This module works with Zend Framework 2 and 3, but
`zendframework/zend-servicemanager` must be at least at version 2.7.6.

Please see the [composer.json](composer.json) file.

## Installation

Run the following `composer` command:

```console
$ composer require fabiang/doctrine-dynamic-zf
```

## Configuration

Load the module by adding it to `config/application.config.php`:

```php
return [
    'modules' => [
        /* ** */
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
                'oneToOne' => [
                    'oneToOne' => [
                        [
                            'targetEntity' => \Mymodule\Entity\Products::class,
                            'inversedBy'   => 'oneToOne',
                            'joinColumns'  => [
                                'name'                 => 'oneToOne',
                                'referencedColumnName' => 'id'
                            ]
                        ]
                    ]
                ]
            ]
        ],
        \Mymodule\Entity\Products::class => [
            'fields' => [
                'oneToOne' => [
                    'oneToOne' => [
                        [
                            'targetEntity' => \Mymodule\Entity\Customer::class,
                            'mappedBy'     => 'oneToOne',
                        ]
                    ]
                ]
            ]
        ],
    ]
];
```

## LICENSE

BSD-2-Clause. See the [LICENSE](LICENSE.md).
