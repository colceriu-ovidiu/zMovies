<?php
namespace Security\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Security\Entity\User;

class LoadUsersData implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        $entity = new User();
        $entity->setUsername('demo');
        $entity->setPassword('demo123', '12345');
        $entity->setRole('user');
        
        $manager->persist( $entity );   
                
        $manager->flush();
    }
    
}