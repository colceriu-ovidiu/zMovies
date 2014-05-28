<?php

namespace Security\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Session\Container;

use Security\Form\LoginForm;

class AuthController extends AbstractActionController
{

    protected $authservice;
    
    const ROLE_USER="user";
    const ROLE_ADMIN="admin";
    
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('doctrine.authenticationservice.orm_default');
        }
        
        return $this->authservice;
    }

    public function authenticateAction()
    {
        $request = $this->getRequest();
        
        $auth = $this->getAuthService();
        $auth->getAdapter()
            ->setIdentityValue( $request->getPost('username') )
            ->setCredentialValue( $request->getPost('password') );           
        $result = $auth->authenticate();        
        
        $fm = $this->flashmessenger();
        foreach($result->getMessages() as $message)
        {
            $fm->addMessage($message);
        }     
        
        switch ($result->getCode()) {
            case Result::SUCCESS :
                $this->flashmessenger()->addMessage('SUCCESS');
                /*$url_session = new Container('url');
                echo $url_session->back_url;
                exit(1);
                return $this->redirect()->toUrl( $url_session->back_url );*/
                return $this->redirect()->toRoute( 'home' );
                break;
            case Result::FAILURE_CREDENTIAL_INVALID : $fm->addMessage('FAILURE_CREDENTIAL_INVALID') ; break;
            case Result::FAILURE_IDENTITY_AMBIGUOUS : $fm->addMessage('FAILURE_IDENTITY_AMBIGUOUS') ; break;
            case Result::FAILURE_IDENTITY_NOT_FOUND : $fm->addMessage('FAILURE_IDENTITY_NOT_FOUND') ; break;
            case Result::FAILURE_UNCATEGORIZED : $fm->addMessage('FAILURE_UNCATEGORIZED') ; break;
            case Result::FAILURE : $fm->addMessage('FAILURE') ; break;
        }
        
        // redirect to login
        //return $this->redirect()->toRoute( $this->url()->fromRoute('myauth', array('action'=>'login')); );
        return $this->redirect()->toRoute('admin', array('controller'=>'auth', 'action' => 'login'));
    }

    public function adminLoginAction() {
        
        $auth = $this->getAuthService();
        $admin_user = $auth->getIdentity();
        
        if (!isset($admin_user)) {
    
            $form = new LoginForm();          
            $urlAction = $this->url()->fromRoute('authenticate');
            $form->setAttribute('action', $urlAction);
            
            //$messages = array();
            $messages = $this->flashmessenger()->getMessages();
            if (!is_Array($messages)) $messages = array();
                    
            return array(
                'loggedin'  => false,
                'form'      => $form,
                'messages'  => $messages,
            );
        } else {
            
            return array(
                'loggedin'  => true,
                'username'  => $admin_user->getUsername(),
            );
        }
    }
    
    public function loginAction() {
        
        $auth = $this->getAuthService();
        $admin_user = $auth->getIdentity();
        
        if (!isset($admin_user)) {
            $url_session = new Container('url');
            if (!isset($url_session->back_url)) {
                $url = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $this->url()->fromRoute('myauth', array('action'=>'home'));
                $url_session->back_url = $url;
            }
    
            $form = new LoginForm();          
            $urlAction = $this->url()->fromRoute('authenticate');
            $form->setAttribute('action', $urlAction);
            
            //$messages = array();
            $messages = $this->flashmessenger()->getMessages();
            if (!is_Array($messages)) $messages = array();
                    
            return array(
                'loggedin'  => false,
                'form'      => $form,
                'messages'  => $messages,
            );
        } else {
            
            return array(
                'loggedin'  => true,
                'username'  => $admin_user->getUsername(),
            );
        }
    }
    
    public function homeAction() {
        echo "wellcome home";
    }

    public function getLoggedinUser() {
        $auth = $this->getAuthService();
        $admin_user = $auth->getIdentity();
                
        return $admin_user;
    }


    public function logoutAction()
    {
        $fm = $this->flashmessenger('auth_mess');
        if ($this->getAuthService()->hasIdentity()) {
            $this->getAuthService()->clearIdentity();
            $fm->addMessage("You've been logged out");
        }
        
        return $this->redirect()->toRoute('login');
    }        
        
    public function indexAction()
    {
        return new ViewModel();
    }


}

