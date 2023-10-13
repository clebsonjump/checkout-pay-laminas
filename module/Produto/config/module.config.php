<?php
namespace Produto;

use Laminas\Router\Http\Segment;

return [

    'router' => [
        'router_class' => Laminas\Mvc\I18n\Router\TranslatorAwareTreeRouteStack::class,
        'routes' => [
            'produto' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/produto[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProdutoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];