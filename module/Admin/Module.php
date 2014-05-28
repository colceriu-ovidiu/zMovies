<?php
namespace Admin;

class Module
{
    protected $viewModel = null;
    protected $serviceManager = null;
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getVM($e) {
        if (!isset($this->viewModel)) {
            $this->viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        }
        return $this->viewModel;
    }
    
    public function getSM($e) {
        if (!isset($this->serviceManager)) {
            $this->serviceManager = $e->getApplication()->getServiceManager();
        }
        return $this->serviceManager;
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

            // obtain current controller and action - required for menu highlight            
            $routeMatch = $e->getRouteMatch();

            $cur_controller = $routeMatch->getParam('controller');
            $cur_action = $routeMatch->getParam('action');
            
            
            $this->getVM($e)->controller = $cur_controller;
            $this->getVM($e)->action = $cur_action;

            
            $this->getVM($e)->loggedinUser = (isset($loggedinUser))? $loggedinUser->getUsername() : null ;
            
        }, 100);
        
        
    }
    
   // public function getServiceConfig()
/*{    
     return array(
        'factories' => array(
            'Admin\Service\AuthService' => function ($sm) {
                return new \Admin\Service\AuthService($sm);
            },
        )
    );   
}*/
/*{    
     return array(
        'invokables' => array(
             'Auth' => 'Admin\Controller\AuthController',
         ),
    );   
}*/

}
