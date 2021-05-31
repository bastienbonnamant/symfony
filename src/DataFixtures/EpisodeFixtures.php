<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture
{

    

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $key => $episodesName)
        {
            $episodes = new Episode();
            $episodes->setName($episodesName);

            $manager->persist($episodes);
        } 
        $manager->flush();
    }
}
