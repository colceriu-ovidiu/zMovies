<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Adapter;
use Zend\Paginator\Paginator;
// --- OR ---
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        return new ViewModel();
    }
    
    public function testAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            
        $user = new \Application\Entity\User();
        $user->setFullName('Marco Pivetta');
        
        $em->persist($user);
        
        $em->flush();
        
        die(var_dump($user->getId()));
    }

    public function listAction()
    {
        // Create a Doctrine Collection
        $collection = new ArrayCollection(range(1, 101));
        
        // Create the paginator itself
        $paginator = new Paginator(new Adapter($collection));
        
        $paginator
            ->setCurrentPageNumber(1)
            ->setItemCountPerPage(5);
            
        // ---- OR -------------
        
        // Create a Doctrine Collection
        $query = $em->createQuery('SELECT f FROM Foo f JOIN f.bar b');
        
        // Create the paginator itself
        $paginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($query))
        );
        
        $paginator
            ->setCurrentPageNumber(1)
            ->setItemCountPerPage(5);
    
        return new ViewModel();
    }
    
}
