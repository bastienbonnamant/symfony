<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Program;



class ProgramFixtures extends Fixture implements DependentFixtureInterface

{
    public const PROGRAMS = [
        
    ];

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for($i=0; $i<10; $i++)
        {
            $programs = new Program();
            $programs->setTitle($faker->text(15));
            $programs->setName($faker->text(15));
            $programs->setSummary($faker->text(200));
            $programs->setPoster($faker->text(200));
            $programs->setCategory($this->getReference('category_' . $i));
            $manager->persist($programs);
            $this->addReference('program_' . $i, $programs);

        } 
        $manager->flush();

    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }

    

    



}
