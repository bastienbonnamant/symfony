<?php
// src/Controller/ProgramController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;





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
    public function show(Program $program) : Response
    {
        /*$program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findOneBy(['id' => $id]);

        $season = $this->getDoctrine()
        ->getRepository(Season::class)
        ->findAll(['program' => $id]);

        if(!$program){
            throw $this->createNotFoundException(
                'No program with id : ' .$id. 'found in program\'s table.' 
            );
        }*/
        
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
        /*$program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findOneBy(['id' => $programId]);
        
        $season = $this->getDoctrine()
        ->getRepository(Season::class)
        ->findOneBy(['id' => $seasonId]);

        $episode = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findBy(['season' => $seasonId]);*/

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