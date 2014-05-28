<?php
namespace Admin;

return array(
     'controllers' => array(
         'invokables' => array(
             'Movie' => 'Admin\Controller\MovieController',
             'Category' => 'Admin\Controller\CategoryController',
             'Admins' => 'Admin\Controller\AdminsController',
             'Settings' => 'Admin\Controller\SettingsController',
             'Dashboard' => 'Admin\Controller\DashboardController',
         ),
         
    ),
    

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'admin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin[/]',
                     'defaults' => array(
                         'controller' => 'dahsboard',
                         'action'     => 'index',
                     ),
                 ),
             ),

             'admin_category' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/category[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Category',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'admin_movie' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/movie[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Movie',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
         ),
     ),
    
    /*'data-fixture' => array(
        __NAMESPACE__.'_fixtures' => __DIR__ . '/../src/'.__NAMESPACE__.'/Fixture',
    ),*/
        
    
     'view_manager' => array(
         'template_path_stack' => array(
             'admin' => __DIR__ . '/../view',
         ),
     ),
     
    'module_layouts' => array(
        'Admin' => 'layout/backend_layout.phtml',
        /*'Admin_login' => 'layout/layout_login.phtml',*/
    ),
    
 );