<?php
namespace Checkout;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases' => [
            Interface\CheckoutRepositoryInterface::class => Model\LaminasDbSqlRepository::class,
            Interface\CheckoutCommandInterface::class => Model\Checkout\CheckoutCommand::class,
            Interface\CheckoutCommandInterface::class => Model\LaminasDbSqlCommand::class,
            Util::class => InvokableFactory::class,
        ],
        'factories' => [
            Model\Checkout\CheckoutRepository::class => InvokableFactory::class,
            Model\LaminasDbSqlRepository::class => Factory\Checkout\LaminasDbSqlRepositoryFactory::class,
            Model\Checkout\CheckoutCommand::class => InvokableFactory::class,
            Model\LaminasDbSqlCommand::class => Factory\Checkout\LaminasDbSqlCommandFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\CheckoutController::class => Factory\Checkout\CheckoutControllerFactory::class,
            Controller\DeleteController::class => Factory\Checkout\DeleteControllerFactory::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'meuHelper' => Checkout\view\Helper\Util::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'router'          => [
        'routes' => [
            'checkout' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/checkout',
                    'defaults' => [
                        'controller' => Controller\CheckoutController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'detail' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/:id',
                            'defaults' => [
                                'action' => 'detail',
                            ],
                            'constraints' => [
                                'id' => '\d+',
                            ],
                        ],
                    ],

                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => Controller\CheckoutController::class,
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'controller' => Controller\CheckoutController::class,
                                'action'     => 'edit',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'controller' => Controller\DeleteController::class,
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];