<?php

namespace Admin\Controller;

use Admin\Controller\UberAdminController;
use Admin\Form\CategoryForm;

class CategoryController extends UberAdminController
{

    public function __construct() {
        $this->entityName = 'Movie\Entity\Category';
        $this->indexRoute = 'admin';
        $this->indexRouteData = array('controller'=>'category', 'action'=>'index');
    }
    
    public function getUpdateForm() {
        $form = new CategoryForm($this->getEM());
        return $form;
    }
    
}