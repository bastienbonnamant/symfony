<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface

{

    const EPISODES = [
        
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<10; $i++)
        {
            $episodes = new Episode();
            $episodes->setTitle($faker->text(15));
            $episodes->setNumber($i);
            $episodes->setSynopsis($faker->text(200));
            $episodes->setSeason($this->getReference('season_' . $i));
            $manager->persist($episodes);
            $this->addReference('episodes_' . $i, $episodes);

        } 
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            SeasonFixtures::class
        );
    }
}
