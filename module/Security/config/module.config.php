<?php
namespace Security;

return array(
     'controllers' => array(
         'invokables' => array(
             'AuthC' => 'Security\Controller\AuthController',
         ),    
    ),
     
    'service_manager' => array(     
         'invokables' => array(
             'Auth' => 'Security\Controller\AuthController',
             'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService',
         ),
    ),
    

     // The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
             'admin_login' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/login',
                     'defaults' => array(
                        'controller'=> 'AuthC',
                        'action'    => 'adminLogin',
                     ),
                 ),
             ),
             
            'login' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/login',
                     'defaults' => array(
                         'controller' => 'AuthC',
                         'action'     => 'login',
                     ),
                 ),
             ),             
             
             'logout' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/logout',
                     'defaults' => array(
                        'controller'=> 'AuthC',
                        'action'    => 'logout',
                     ),
                 ),
            ),
             
            'authenticate' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/authenticate',
                     'defaults' => array(
                         'controller' => 'AuthC',
                         'action'     => 'authenticate',
                     ),
                 ),
             ),             
             
        ),     
     ),
     
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Security/Entity')
            ),
        
            'orm_default' => array(
              'drivers' => array(
                'Security\Entity' => 'application_entities'
              )
            )
        ),

        'authentication' => array(
            'orm_default' => array(
                //should be the key you use to get doctrine's entity manager out of zf2's service locator
                'objectManager' => 'Doctrine\ORM\EntityManager',
                //fully qualified name of your user class
                'identityClass' => 'Security\Entity\User',
                //the identity property of your class
                'identityProperty' => 'username',
                //the password property of your class
                'credentialProperty' => 'password',
                //a callable function to hash the password with
                'credentialCallable' => 'Security\Entity\User::hashPassword'
            ),
        ),
        
    ),
    
    'data-fixture' => array(
        __NAMESPACE__.'_fixtures' => __DIR__ . '/../src/'.__NAMESPACE__.'/Fixture',
    ),
        
    
     'view_manager' => array(
         'template_path_stack' => array(
             'admin' => __DIR__ . '/../view',
         ),
     ),
     
     
     'layouts_login'=> array(
        'frontend' => 'layout/layout_frontend_login.phtml',
        'backend' => 'layout/backend_layout.phtml',
     ),
     
     
    'module_layouts' => array(
        'Security' => 'layout/layout_frontend_login.phtml',
    ),
    
 );