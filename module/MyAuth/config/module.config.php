<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'MyAuth\Controller\Auth' => 'MyAuth\Controller\AuthController',
        ),
    ),
    'router' => array(
        'routes' => array(
            
            'myauth' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/myauth[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'MyAuth\Controller\Auth',
                         'action'     => 'index',
                     ),
                 ),
             ),
            
            /*'success' => array(
            ),*/
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'MyAuth' => __DIR__ . '/../view',
        ),
    ),
);