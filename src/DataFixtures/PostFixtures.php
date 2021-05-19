<?php


namespace App\DataFixtures;


use App\Entity\Post;
use App\Repository\TagRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var TagRepository
     */
    private $tagRepository;


    /**
     * PostFixtures constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this-> tagRepository = $tagRepository;
    }

    public function getDependencies()
    {
        return [
            TagFixtures::class,
        ];
    }

    /**
     * @param ObjectManager $manager
     *
     */

    public function load(ObjectManager $manager)
    {
        $tags = $this->tagRepository->findAll();

        for ($count = 0; $count < 10; $count++){
            $post = new Post();
            $post->setTitle("Titre " . $count);
            $post->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse convallis tristique lobortis. Nunc mauris odio, finibus at mattis in, fermentum at nisl. Morbi ultrices convallis tortor quis mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut molestie vel enim eu bibendum. Aliquam elementum, est vel ultricies pulvinar, sapien dolor accumsan tortor, eget cursus neque tellus in quam. Nullam interdum, odio eget condimentum congue, felis nisi dignissim odio, vitae ultrices elit diam id risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla erat dolor, semper sed posuere pharetra, elementum rhoncus justo. Vestibulum ut erat accumsan, eleifend ante vitae, ullamcorper felis. Etiam interdum tortor eget leo mattis facilisis. Maecenas mollis nisi in justo lacinia, at facilisis neque ornare. Phasellus vitae pharetra mi. Maecenas ut aliquet erat. Cras vehicula sit amet neque ac fringilla.");
            $post->setPublished(1);
            $random = mt_rand(0,count($tags) - 1);
            $randomTag = $tags[$random];
            $post->addTag($randomTag);
            $manager->persist($post );
        }
        $manager->flush();

    }
}
