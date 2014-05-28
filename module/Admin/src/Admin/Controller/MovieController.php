<?php

namespace Admin\Controller;

use Admin\Controller\UberAdminController;
use Admin\Form\MovieForm;

class MovieController extends UberAdminController
{

    public function __construct() {
        $this->entityName = 'Movie\Entity\Movie';
        $this->indexRoute = 'admin';
        $this->indexRouteData = array('controller'=>'movie', 'action'=>'index');
    }
    
    public function getUpdateForm() {
        $form = new MovieForm($this->getEM());
        return $form;
    }    
    
}