<?php

namespace Movie;

 // Add these import statements:
 use Album\Model\Album;
 use Album\Model\AlbumTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 class Module
 {
     // getAutoloaderConfig() and getConfig() methods here
	 
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }	 

     // Add this method:
     /*public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Album\Model\AlbumTable' =>  function($sm) {
                     $tableGateway = $sm->get('AlbumTableGateway');
                     $table = new AlbumTable($tableGateway);
                     return $table;
                 },
                 'AlbumTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Album());
                     return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }*/
	 
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    

    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');
            
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
            
        }, 100);
        
    }
    
    public function getViewHelperConfig()
    {
	return array(
	    'factories' => array(
		'Login_widget' => function ($helperPluginManager) {
		    $serviceLocator = $helperPluginManager->getServiceLocator();
		    $viewHelper = new View\Helper\Loginhelper();
		    $viewHelper->setServiceLocator($serviceLocator);
		    return $viewHelper;
		}
	    )
	);  
    }    
    
 }