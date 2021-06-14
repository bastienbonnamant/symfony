<?php
// src/Controller/ProgramController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\EntityProgram;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Slugify;


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
     * The controller for the program add form
     * Display the form or deal with it
     *
     * @Route("/newprogram", name="newprogram")
     */
    public function new(Request $request, EntityManagerInterface $manager, Slugify $slugify) : Response
    {
        $slug = $slugify->generate($program->getTitle());
        $program->setSlug($slug);

        // Create a new Program Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted()&& $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($program);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('program_index');
        }

    

        // Render the form
        return $this->render('category/newprogram.html.twig', ["form" => $form->createView()]);
    }
    
    /** 
     * @param int $id
     * @return Response
    * @Route("/programs/{slug}", methods={"GET"}, name="program_show")
    */
    public function show(Program $program) : Response
    {
        
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $program->getSeasons()
            ]);
    }


    /** 
     * @param int $id
     * @return Response
    * @Route("/programs/{program}/seasons/{season}", methods={"GET"}, name="program_season_show")
    */
    public function showSeason(Program $program, Season $season): Response
    {

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $season->getEpisodes()
            
            ]);

        
    }

    /** 
     * @param int $id
     * @return Response
    * @Route("/programs/{program}/seasons/{season}/episodes/{episode}", methods={"GET"}, name="program_episode_show")
    */
    public function showEpisode(Program $program, Season $season, Episode $episode)
    {

        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);

    }


}