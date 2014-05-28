<?php
namespace Movie\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Movie\Entity\Movie;

class LoadMoviesData implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        $repoCat = $manager->getRepository('\Movie\Entity\Category');
        
        $cat = $repoCat->findOneByTitle('Comedy');
               
        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Monty Python');
        $entity->setDescription('smooth relentless humor');
        $entity->setReleaseDate( new \DateTime('20-10-2013') );
        $entity->setActive(true);
        
        $manager->persist( $entity );

        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Other Guys');
        $entity->setDescription('crazy');
        $entity->setReleaseDate( new \DateTime('20-12-2013') );
        $entity->setActive(true);
        
        $manager->persist( $entity );

        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Jackass');
        $entity->setDescription('so so');
        $entity->setReleaseDate( new \DateTime('20-06-2010') );
        $entity->setActive(true);
        
        $manager->persist( $entity );

        $cat = $repoCat->findOneByTitle('Action');

        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Spider Man');
        $entity->setDescription('teenage crap');
        $entity->setReleaseDate( new \DateTime('20-10-2012') );
        $entity->setActive(true);
        
        $manager->persist( $entity );
        
        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Indiana Jones');
        $entity->setDescription('Delightfull jorney through the imaginary misteries of the world');
        $entity->setReleaseDate( new \DateTime('19-10-1987') );
        $entity->setActive(true);
        
        $manager->persist( $entity );
        
        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Robocop');
        $entity->setDescription('the future is safe');
        $entity->setReleaseDate( new \DateTime('20-09-1991') );
        $entity->setActive(true);
        
        $manager->persist( $entity );
        
        $cat = $repoCat->findOneByTitle('Sci-Fi');

        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Terminator');
        $entity->setDescription('some guy from politics is pissed');
        $entity->setReleaseDate( new \DateTime('20-06-1991') );
        $entity->setActive(true);
        
        $manager->persist( $entity );
        
        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Indiana Jones');
        $entity->setDescription('Delightfull jorney through the imaginary misteries of the world');
        $entity->setReleaseDate( new \DateTime('19-10-1987') );
        $entity->setActive(true);
        
        $manager->persist( $entity );
        
        $entity = new Movie();
        $entity->setCategory($cat);
        $entity->setTitle('Aripi de zapada');
        $entity->setDescription('Filmul prezinta aventurile eroilor din Ciresarii in timpul vacantei de iarna, intr-o tabara la munte.');
        $entity->setReleaseDate( new \DateTime('20-09-1985') );
        $entity->setActive(true);
        
        $manager->persist( $entity );

        $manager->flush();
    }
    
}