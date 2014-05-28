<?php
namespace Movie;

return array(
     'controllers' => array(
         'invokables' => array(
             'MovieC' => 'Movie\Controller\MovieController',
             'CategoryC' => 'Movie\Controller\CategoryController',
         ),
     ),
     
    'service_manager' => array(
        'invokables' => array(
            'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService',
        ),
    ),     

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'movie' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/Movie[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'MovieC',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
             'categories' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/categories[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'CategoryC',
                         'action'     => 'list',
                     ),
                 ),
             ),
             
             
             
            /* 'auth' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/Auth[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Movie\Controller\Auth',
                         'action'     => 'login',
                     ),
                 ),
             ),
             
             'login' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/login',
                     'defaults' => array(
                         'controller' => 'Movie\Controller\Auth',
                         'action'     => 'login',
                     ),
                 ),
             ),
             
             'logout' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/logout',
                     'defaults' => array(
                         'controller' => 'Movie\Controller\Auth',
                         'action'     => 'logout',
                     ),
                 ),
             ),*/
             
         ),
     ),
     
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Movie/Entity')
            ),
        
            'orm_default' => array(
              'drivers' => array(
                'Movie\Entity' => 'application_entities'
              )
            ),
            
            /*'orm_auth_users' => array(
              'drivers' => array(
                'Movie\Entity' => 'application_entities'
              )
            ),*/

        ),
        
        'authentication' => array(
            'orm_default' => array(
                /*'application'=> array(
                    //should be the key you use to get doctrine's entity manager out of zf2's service locator
                    //'objectManager' => 'Doctrine\ORM\EntityManager',
                    'objectManager' => 'doctrine.entitymanager.orm_auth_users',
                    //fully qualified name of your user class
                    'identityClass' => 'Movie\Entity\User',
                    //the identity property of your class
                    'identityProperty' => 'username',
                    //the password property of your class
                    'credentialProperty' => 'password',
                    //a callable function to hash the password with
                    'credentialCallable' => 'Movie\Entity\User::hashPassword'
                )*/
                
                //should be the key you use to get doctrine's entity manager out of zf2's service locator
                //'objectManager' => 'Doctrine\ORM\EntityManager',
                'objectManager' => 'Doctrine\ORM\EntityManager',
                //fully qualified name of your user class
                'identityClass' => 'Movie\Entity\User',
                //the identity property of your class
                'identityProperty' => 'username',
                //the password property of your class
                'credentialProperty' => 'password',
                //a callable function to hash the password with
                'credentialCallable' => 'Movie\Entity\User::hashPassword'
                
            ),
        ),

    
    ),

    'orm_auth_Movie' => array(
        /*'application'=> array(
            //should be the key you use to get doctrine's entity manager out of zf2's service locator
            //'objectManager' => 'Doctrine\ORM\EntityManager',
            'objectManager' => 'doctrine.entitymanager.orm_auth_users',
            //fully qualified name of your user class
            'identityClass' => 'Movie\Entity\User',
            //the identity property of your class
            'identityProperty' => 'username',
            //the password property of your class
            'credentialProperty' => 'password',
            //a callable function to hash the password with
            'credentialCallable' => 'Movie\Entity\User::hashPassword'
        )*/
        
        //should be the key you use to get doctrine's entity manager out of zf2's service locator
        //'objectManager' => 'Doctrine\ORM\EntityManager',
        'objectManager' => 'Doctrine\ORM\EntityManager',
        //fully qualified name of your user class
        'identityClass' => 'Movie\Entity\User',
        //the identity property of your class
        'identityProperty' => 'username',
        //the password property of your class
        'credentialProperty' => 'password',
        //a callable function to hash the password with
        'credentialCallable' => 'Movie\Entity\User::hashPassword'
        
    ),

    
    'data-fixture' => array(
        __NAMESPACE__.'_fixtures' => __DIR__ . '/../src/'.__NAMESPACE__.'/Fixture',
    ),
    
    'view_manager' => array(
         'template_path_stack' => array(
             'movie' => __DIR__ . '/../view',
         ),
     ),
    
     
    'module_layouts' => array(
        'Movie' => 'layout/frontend_layout.phtml',
    ),
    
    
 );