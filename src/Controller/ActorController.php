<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actor;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor", name="actor")
     */
    public function index(): Response
    {

        $actors = $this->getDoctrine()
             ->getRepository(Actor::class)
             ->findAll();

        return $this->render('actor/index.html.twig', [
            'actors' => $actors
            
        ]);
    }

    /** 
     * @return Response
    * @Route("/actor/{id}", methods={"GET"}, name="actor_show")
    */
    public function show(Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            ]);
    }

}
