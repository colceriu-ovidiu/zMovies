<?php

namespace Movie\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
  use Album\Model\Album;         
 use Album\Form\AlbumForm;       

 class MovieController extends AbstractActionController
 {
    
    protected $albumTable;
    
    public $em;
    
    public function getEM() {
        if (!isset($this->em)) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->em;
    }    
    
     public function indexAction()
     {
         $catid = (int) $this->params()->fromRoute('id', 0);
         
         // obtain data from DB
         $repoCat = $this->getEM()->getRepository('Movie\Entity\Category');
         $repoMov = $this->getEM()->getRepository('Movie\Entity\Movie');
      
         $curcat = null;
         
         if ($catid==0) {
            $movs = $repoMov->findAll();            
         } else {
            $curcat = $repoCat->findOneById($catid);
            
            $movs = $repoMov->findByCategory($curcat);
         }
         
         // convert
         $res = array();
                  
         foreach ($movs as $mov) {
            $res[] = array('id'=>$mov->getId(), 'title'=>$mov->getTitle());
         }
      
        return new ViewModel(array(
             'res' => $res,
             'cur_cat' => ($curcat==null)? 'All' : $curcat->getTitle(),
         ));
     }
     
     public function treeAction() {
         $repoMov = $this->getEM()->getRepository('Movie\Entity\Movie');
         $movs = $repoMov->findAll();

         // convert
         $res = array();
                  
         foreach ($movs as $mov) {
            $res[$mov->getCategory()->getId()]['title'] = $mov->getCategory()->getTitle();
            $res[$mov->getCategory()->getId()]['res'][] = array('id'=>$mov->getId(), 'title'=>$mov->getTitle());
         }
         
        return new ViewModel(array(
             'res' => $res,
         ));
     }
     
     /*public function addAction()
     {
         $form = new AlbumForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $album = new Album();
             $form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $album->exchangeArray($form->getData());
                 $this->getAlbumTable()->saveAlbum($album);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('album');
             }
         }
         return array('form' => $form);        
     }*/

     /*public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('album', array(
                 'action' => 'add'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $album = $this->getAlbumTable()->getAlbum($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('album', array(
                 'action' => 'index'
             ));
         }

         $form  = new AlbumForm();
         $form->bind($album);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getAlbumTable()->saveAlbum($album);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('album');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );        
     }*/

     /*public function deleteAction()
     {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('album');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getAlbumTable()->deleteAlbum($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('album');
         }

         return array(
             'id'    => $id,
             'album' => $this->getAlbumTable()->getAlbum($id)
         );        
     }*/
     
     public function getAlbumTable()
     {
         if (!$this->albumTable) {
             $sm = $this->getServiceLocator();
             $this->albumTable = $sm->get('Album\Model\AlbumTable');
         }
         return $this->albumTable;
     }
 }