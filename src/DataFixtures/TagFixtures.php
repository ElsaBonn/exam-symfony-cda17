<?php


namespace App\DataFixtures;


use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{


    /**
     * @param ObjectManager $manager
     *
     */
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 10; $count++) {
            $tag = new Tag();
            $tag->setName("Tag n° " . $count);
            $manager->persist($tag);

        }

        $manager->flush();
    }
}
