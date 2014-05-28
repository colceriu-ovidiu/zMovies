<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UberAdminController extends AbstractActionController
{

    public $em;
    
    public $entityName = '';
    public $indexRoute = '';
    public $indexRouteData = array();
    
    public function getEM() {
        if (!isset($this->em)) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->em;
    }    
    
     
    public function indexAction()
    {
         // obtain data from DB
         $repo = $this->getEM()->getRepository($this->entityName);
         $movs = $repo->findAll();

         // convert to a "viewable" format
         $res = array();
         foreach ($movs as $mov) {
            $res[] = array('id'=>$mov->getId(), 'title'=>$mov->getTitle());
         }
         
        return new ViewModel(array(
             'res' => $res,
         ));
    }
    
    public function addupdateAction()
     {
         $request = $this->getRequest();
         
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
            $id = $request->getPost('id', null);
         }
         
         if ($id>0) {            
            $repo = $this->getEM()->getRepository($this->entityName);
            $entity = $repo->find($id);
         } else {
            $entity = new $this->entityName;   
         }
        
         
        $form = $this->getUpdateForm();
         
         if ($request->isPost()) {
             $form->bind($entity);
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                 $this->getEM()->persist($entity);
                 $this->getEM()->flush();

                 // Redirect to list of albums
                 return $this->redirect()->toRoute($indexRoute, $indexRouteData);
             }
         } else {
            if ($id>0) {
                $form->bind($entity);
            }
         }
         
         return array('form' => $form);
     }
     
     
    public function deleteAction()
     {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
            // return $this->redirect()->toRoute('album');
         }
         
        $repo = $this->getEM()->getRepository($this->entityName);
        $entity = $repo->find($id);

        $this->getEM()->remove($entity);
        
        $this->getEM()->flush();

        // Redirect to list of albums
        return $this->redirect()->toRoute($indexRoute, $indexRouteData);;
     }
     
    /**
     * Override
     **/
    public function getUpdateForm() {}
}