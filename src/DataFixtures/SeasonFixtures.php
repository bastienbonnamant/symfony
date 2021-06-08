<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class SeasonFixtures extends Fixture implements DependentFixtureInterface

{

    const SEASONS = [
        
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<10; $i++)
        {
            $seasons = new Season();
            $seasons->setNumber($i);
            $seasons->setYear($faker->date('Y'));
            $seasons->setDescription($faker->text(200));
            $seasons->setProgram($this->getReference('program_' . $i));
            $manager->persist($seasons);

            $this->addReference('season_' . $i, $seasons);
        } 
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProgramFixtures::class
        );
    }
}