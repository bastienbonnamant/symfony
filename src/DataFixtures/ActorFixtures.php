<?php
namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTORS = [
        
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<10; $i++)
        {
            $actors = new Actor();
            $actors->setName($faker->text(15));
            $actors->addProgram($this->getReference('program_' . $i));
            $manager->persist($actors);

            $this->addReference('actors_' . $i, $actors);

        } 
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProgramFixtures::class,
        ];
    }

    
}
