<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BugController extends AbstractController
{
    /**
     * @Route("/bug", name="bug")
     * @param CharacterRepository $characterRepository
     * @return Response
     */
    public function index(CharacterRepository $characterRepository): Response
    {
        // On injecte le service "CharacterRepository"

        // On injecte le service "DiceThrower"
//        $diceThrower = $this->getDiceThrower();
        // On récupère la liste des personnages
//        $characters = $characterRepository->findBy([
//            'strentgh' => 'DESC',
//        ]);
        // On affiche la vue
        return $this->render('bug/index.html.twig',[
//            'characters' => $characterRepository->findBy([
//                'strength' => 'DESC',
        'characters'=> $characterRepository->findAll(),
//            ])
        ]);
    }
}
