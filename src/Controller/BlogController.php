<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/blog/{id}", name="article_for_blog")
     * @param String $id
     * @return Response
     */
    public function post (String $id): Response
    {
        return $this->render('blog/post.html.twig', [
            'id' => $id,
        ]);

    }

    /**
     * @Route("/new", name="blog_new",
     *     methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new (Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        //formulaire et l'objet que l'on veut mettre a jour grâce au formulaire
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request); // on prend les données POST quand le formulaire est fournis et les mettre dans contact
        // si formulaire est valide on registre
        if ($form->isSubmitted() && $form->isValid()){
//             dd($contact);
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('blog_new');
        }

        return $this->render('blog/new.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}
