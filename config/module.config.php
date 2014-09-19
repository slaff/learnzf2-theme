<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Theme\Controller\Index' => 'Theme\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'theme' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/theme',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Theme\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'change' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/change/:theme',
                            'constraints' => array(
                                'theme'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => 'change'
                            ),
                        ),
                    )
                ),
            ),
        ),
    ),
    'service_manager' =>  array(
        'invokables' => array(
            'theme' => 'Theme\Service\ThemeInvokable',
            'theme-storage' => 'Theme\Service\ThemeStorageInvokable',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Theme' => __DIR__ . '/../view',
        ),
    ),

    'themes' => array (
        'default' => array (
            'description' => 'This is your default theme',
        )
    ),

    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Themes',
                'route' => 'theme',
            ),
        )
    ),
);
