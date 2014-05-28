<?php
namespace Movie\View\Helper;

use Zend\View\Helper\AbstractHelper;
//use Application\Form\LoginForm;
use Zend\ServiceManager\ServiceManager;

class Loginhelper  extends AbstractHelper {
    
    protected $serviceLocator;
    protected $authService;
    
    public function __invoke() {
        //$this->authService = $this->serviceLocator->get('AuthService');

        /*if($this->authService->hasIdentity()){
            return $this->getView()->render('partial/login', array('getIdentity' => $this->authService->getIdentity()));
        }
        else{
            $form=new LoginForm();
            return $this->getView()->render('partial/login', array('form' => $form));
        } */       

        return $this->getView()->render('movie/loginbarPartial.phtml');

    }
    
    public function setServiceLocator(ServiceManager $serviceLocator){
        $this->serviceLocator = $serviceLocator;
    }
    
}