<?php

namespace MyAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Session\Container;

use MyAuth\Form\LoginForm;

class AuthController extends AbstractActionController
{

    protected $authservice;
    
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        
        return $this->authservice;
    }

    /*public function createDbdata() {
        // Create a SQLite database connection
        $dbAdapter = new DbAdapter(array(
                        'driver' => 'Pdo_Sqlite',
                        'database' => 'sqlite:zendtest1.db'
                    ));

        // Build a simple table creation query
        $sqlCreate = 'CREATE TABLE `users` ('
                   . '`id` INTEGER  NOT NULL PRIMARY KEY, '
                   . '`username` VARCHAR(50) UNIQUE NOT NULL, '
                   . '`password` VARCHAR(32) NULL, '
                   . '`real_name` VARCHAR(150) NULL)';
        
        // Create the authentication credentials table
        $statement = $dbAdapter->query($sqlCreate);
        $statement->execute();
        
        // Build a query to insert a row for which authentication may succeed
        $sqlInsert = "INSERT INTO `users` (username, password, real_name) "
                   . "VALUES ('my_username', 'my_password', 'My Real Name')";
        
        // Insert the data
        $dbAdapter->query($sqlInsert);
    }*/

    public function authenticateAction()
    {
        $request = $this->getRequest();
        
        $this->getAuthService()->getAdapter()
            ->setIdentity( $request->getPost('username') )
            ->setCredential( $request->getPost('password') );
                   
        $result = $this->getAuthService()->authenticate();
        
        $fm = $this->flashmessenger();
        foreach($result->getMessages() as $message)
        {
            $fm->addMessage($message);
        }     
        
        switch ($result->getCode()) {
            case Result::SUCCESS :
                $this->flashmessenger()->addMessage('SUCCESS');
                $url_session = new Container('url');
                echo $url_session->back_url;
                exit(1);
                return $this->redirect()->toUrl( $url_session->back_url );
                break;
            case Result::FAILURE_CREDENTIAL_INVALID : $fm->addMessage('FAILURE_CREDENTIAL_INVALID') ; break;
            case Result::FAILURE_IDENTITY_AMBIGUOUS : $fm->addMessage('FAILURE_IDENTITY_AMBIGUOUS') ; break;
            case Result::FAILURE_IDENTITY_NOT_FOUND : $fm->addMessage('FAILURE_IDENTITY_NOT_FOUND') ; break;
            case Result::FAILURE_UNCATEGORIZED : $fm->addMessage('FAILURE_UNCATEGORIZED') ; break;
            case Result::FAILURE : $fm->addMessage('FAILURE') ; break;
        }
        
        // redirect to login
        //return $this->redirect()->toRoute( $this->url()->fromRoute('myauth', array('action'=>'login')); );
        return $this->redirect()->toRoute('myauth', array('action' => 'login'));
    }
    
    public function loginAction() {
        $url_session = new Container('url');
        if (!isset($url_session->back_url)) {
            $url = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $this->url()->fromRoute('myauth', array('action'=>'home'));
            $url_session->back_url = $url;
        }

        $form = new LoginForm();          
        $urlAction = $this->url()->fromRoute('myauth', array('action'=>'authenticate'));
        $form->setAttribute('action', $urlAction);
        
        //$messages = array();
        $messages = $this->flashmessenger()->getMessages();
        if (!is_Array($messages)) $messages = array();
                
        return array(
            'form'      => $form,
            'messages'  => $messages,
        );
    }
    
    public function homeAction() {
        echo "wellcome home";
    }

    public function logoutAction()
    {
        $fm = $this->flashmessenger('auth_mess');
        if ($this->getAuthService()->hasIdentity()) {
            $this->getSessionStorage()->forgetMe();
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

