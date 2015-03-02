<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 06.12.14 - 22:26
 */
return array(
    'prooph.link.fileconnector' => [
        //The FileConnector module uses an own plugin manager to resolve file type adapters for file types
        //You can configure the file type adapter manager like a normal service manager
        //The file type is the alias that resolves to a FileConnector\Service\FileTypeAdapter
        'file_types' => [
            'invokables' => [
                'csv'  => 'Prooph\Link\FileConnector\Service\FileTypeAdapter\LeagueCsvTypeAdapter',
                'json' => 'Prooph\Link\FileConnector\Service\FileTypeAdapter\JsonTypeAdapter',
            ]

        ],
        //Filename templates are rendered with a mustache template engine. Mixins extend mustache with additional functions
        //A MixinManager is used to resolve mixins.
        //A Mixin should implement the __invoke() method to be used as a callable.
        //The alias of the mixin should also be used in the template.
        'filename_mixins' => [
            'invokables' => [
                'now' => 'Prooph\Link\FileConnector\Service\FileNameRenderer\Mixin\NowMixin',
            ]
        ]
    ],
    'prooph.link.dashboard' => [
        'fileconnector_config_widget' => [
            'controller' => 'Prooph\Link\FileConnector\Controller\DashboardWidget',
            'order' => 91 //50 - 99 connectors range
        ]
    ],
    'router' => [
        'routes' => [
            'prooph.link' => [
                'child_routes' => [
                    'file_connector' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/file-connector',
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'configurator' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/file-manager',
                                    'defaults' => [
                                        'controller' => 'Prooph\Link\FileConnector\Controller\FileManager',
                                        'action' => 'start-app'
                                    ]
                                ]
                            ],
                            'api' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/api',
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'connectors' => [
                                        'type' => 'Segment',
                                        'options' => [
                                            'route' => '/connectors[/:id]',
                                            'constraints' => array(
                                                'id' => '.+',
                                            ),
                                            'defaults' => [
                                                'controller' => 'Prooph\Link\FileConnector\Api\FileConnector',
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => array(
        'template_map' => [
            'prooph.link.file-connector/dashboard/widget' => __DIR__ . '/../view/file-connector/dashboard/widget.phtml',
            'prooph.link.file-connector/file-manager/app' => __DIR__ . '/../view/file-connector/file-manager/app.phtml',
            //Partials for FileConnectorManager
            'prooph.link.file-connector/file-manager/partial/sidebar-left'      => __DIR__ . '/../view/file-connector/file-manager/partial/sidebar-left.phtml',
            //riot tags
            'prooph.link.file-connector/file-manager/riot-tag/file-manager'     => __DIR__ . '/../view/file-connector/file-manager/riot-tag/file-manager.phtml',
            'prooph.link.file-connector/file-manager/riot-tag/connector-list'   => __DIR__ . '/../view/file-connector/file-manager/riot-tag/connector-list.phtml',
            'prooph.link.file-connector/file-manager/riot-tag/connector-details'=> __DIR__ . '/../view/file-connector/file-manager/riot-tag/connector-details.phtml',
            'prooph.link.file-connector/pm/riot-tag/fileconnector-metadata'     => __DIR__ . '/../view/file-connector/pm/riot-tag/fileconnector-metadata.phtml',
        ],
    ),
    'process_manager' => [
        'view_addons' => [
            'prooph.link.file-connector/file-manager/partial/pm-metadata-config'
        ]
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'riot-tags' => [
                'js/prooph/link/file-connector/app.js' => [
                    'prooph.link.file-connector/file-manager/riot-tag/file-manager',
                    'prooph.link.file-connector/file-manager/riot-tag/connector-list',
                    'prooph.link.file-connector/file-manager/riot-tag/connector-details',
                ],
                //Inject process manager metadata configurator for file connectors
                'js/prooph/link/process-config/app.js' => [
                    'prooph.link.file-connector/pm/riot-tag/fileconnector-metadata',
                ],
            ],
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            'prooph.link.fileconnector.file_type_adapter_manager' => 'Prooph\Link\FileConnector\Service\FileTypeAdapter\FileTypeAdapterManagerFactory',
            'prooph.link.fileconnector.filename_mixin_manager'    => 'Prooph\Link\FileConnector\Service\FileNameRenderer\MixinManagerFactory',
            'prooph.link.fileconnector.filename_renderer'         => 'Prooph\Link\FileConnector\Service\FileNameRenderer\FileNameRendererFactory',
        ],
        'abstract_factories' => [
            //Resolves a alias starting with "filegateway:::" to a FileConnector\Service\FileGateway
            'Prooph\Link\FileConnector\Service\FileGateway\AbstractFileGatewayFactory',
        ]
    ],
    'controllers' => array(
        'factories' => [
            'Prooph\Link\FileConnector\Controller\FileManager' => 'Prooph\Link\FileConnector\Controller\Factory\FileManagerControllerFactory',
            'Prooph\Link\FileConnector\Api\FileConnector'          => 'Prooph\Link\FileConnector\Api\Factory\FileConnectorFactory',
        ],
        'invokables' => [
            'Prooph\Link\FileConnector\Controller\DashboardWidget' => 'Prooph\Link\FileConnector\Controller\DashboardWidgetController',
        ]
    ),
    'zf-content-negotiation' => [
        'controllers' => [
            'Prooph\Link\FileConnector\Api\FileConnector' => 'Json',
        ],
        'accept_whitelist' => [
            'Prooph\Link\FileConnector\Api\FileConnector' => ['application/json'],
        ],
        'content_type_whitelist' => [
            'Prooph\Link\FileConnector\Api\FileConnector' => ['application/json'],
        ],
    ],
);