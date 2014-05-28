<?php
namespace Security\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Security\Entity\User;

class LoadAdminsData implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        $entity = new User();
        $entity->setUsername('admin');
        $entity->setPassword('admin123', '12345');
        $entity->setRole('admin');
        
        $manager->persist( $entity );      
                
        $manager->flush();
    }
    
}