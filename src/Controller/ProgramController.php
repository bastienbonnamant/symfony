<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;



Class ProgramController extends AbstractController
{
    /**
     * @Route("/programs", name="program_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
             ->getRepository(Program::class)
             ->findAll();

         return $this->render(
             'program/index.html.twig',
             ['programs' => $programs]
         );
    }

    
    /** 
     * @param int $id
     * @return Response
    * @Route("/programs/{id}", requirements={"id"="\d+"}, methods={"GET"}, name="program_show")
    */
    public function show(int $id) : Response
    {
        $program = $this->getDoctrine()->getRepository(Program::class)->findOneBy(['id' => $id]);

        if(!$program){
            throw $this->createNotFoundException(
                'No program with id : ' .$id. 'found in program\'s table.' 
            );
        }
        
        return $this->render('program/show.html.twig', ['program' => $program,]);
    }
}