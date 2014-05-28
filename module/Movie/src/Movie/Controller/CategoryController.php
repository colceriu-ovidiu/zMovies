<?php

namespace Movie\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
  use Album\Model\Album;         
 use Album\Form\AlbumForm;       

 class CategoryController extends AbstractActionController
 {
    
    protected $albumTable;
    
    public $em;
    
    public function getEM() {
        if (!isset($this->em)) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->em;
    }    
    
     
    public function listAction()
    {
         // obtain data from DB
         $repo = $this->getEM()->getRepository('Movie\Entity\Category');
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
     

 }