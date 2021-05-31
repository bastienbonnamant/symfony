<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $seasonName)
        {
            $season = new Season();
            $season->setName($seasonName);

            $manager->persist($season);
        } 
        $manager->flush();
    }
}