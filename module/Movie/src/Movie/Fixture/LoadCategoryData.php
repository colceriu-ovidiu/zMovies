<?php
namespace Movie\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Movie\Entity\Category;

class LoadCategoryData implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        $entity = new Category();
        $entity->setTitle('Comedy');
        $entity->setActive(true);        
        
        $manager->persist( $entity );
        
        $entity = new Category();
        $entity->setTitle('Action');
        $entity->setActive(true);        
        
        $manager->persist( $entity );
        
        $entity = new Category();
        $entity->setTitle('Sci-Fi');
        $entity->setActive(true);        
        
        $manager->persist( $entity );
        
        $manager->flush();
    }
    
}