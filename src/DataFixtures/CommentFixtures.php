<?php


namespace App\DataFixtures;


use App\Entity\Comment;
use App\Repository\PostRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var PostRepository
     */
    private $postRepository;


    /**
     * CommentFixtures constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this-> postRepository = $postRepository;
    }

    public function getDependencies()
    {
        return[
          PostFixtures::class,
        ];
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $posts = $this->postRepository->findAll();

        for ($count = 0; $count < 10; $count++){
            $comment = new Comment();
            $comment->setTitle("Commentaire ". $count);
            $comment->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse convallis tristique lobortis. Nunc mauris odio, finibus at mattis in, fermentum at nisl. Morbi ultrices convallis tortor quis mattis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut molestie vel enim eu bibendum. Aliquam elementum, est vel ultricies");
            $random = mt_rand(0,count($posts) - 1);
            $randomPost = $posts[$random];
            $comment->setPost($randomPost);
            $manager->persist($comment);



        }

        $manager->flush();
    }
}
