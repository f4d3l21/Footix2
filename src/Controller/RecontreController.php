<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Rencontre;
use App\Repository\RencontreRepository;

class RecontreController extends AbstractController
{
    #[Route('/rencontre', name: 'app_recontre')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecontreController.php',
        ]);
    }

    #[Route('/api/rencontre', name: 'rencontre.getAll', methods: ['GET'])]
    public function getRencontre(
        TeamRepository $repository,
        SerializerInterface $serializer
    ): JsonResponse {
        $rencontre = $repository->findAll();
        $data = $serializer->serialize($rencontre, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/api/rencontre/{id}', name: 'rencontre.getOne', methods: ['GET'])]
    public function getOneRencontre(
        TeamRepository $repository,
        SerializerInterface $serializer,
        int $id
    ): JsonResponse {
        $oneRencontre = $repository->find($id);
        $data = $serializer->serialize($oneRencontre, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/api/teams/{id}/ratio', name: 'rencontre.getOneRatio', methods: ['GET'])]
    public function getOneTeamRatio(
        RencontreRepository $repository,
        SerializerInterface $serializer,
        int $id
        ): JsonResponse
    {
        //$AllRencontre = $repository->createQueryBuilder('')
        // $AllRencontre = $repository->createQueryBuilder(
        //     'SELECT team_a_id, team_b_id,
        //     FROM App\Entity\Rencontre rencontre 
        //     WHERE rencontre.team_a_id = :id 
        //     OR rencontre.team_b_id = :id'
        // );

        // $AllRencontre = $repository->select('team_a, team_b')
        //     ->from('App\Entity\Rencontre', 'rencontre')
        //     ->where('rencontre.team_a_id = :id')
        //     ->or('rencontre.team_b_id = :id');

        // returns an array of Product objects
        $AllRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.teamA = :id')
            ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        $WinnerRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.winner = :id')
            // ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        // $query = $AllRencontre->setParameter('id', $id)
        //     ->getQuery()
        //     ->getResult();
        //return $AllRencontre->getQuery()->getResult();

        //dd('TESTTTTT',$WinnerRencontre);

        //$WinnerRencontre = $repository->findBy(['winner_id' => $id]);
        $ratio = count($WinnerRencontre) / count($AllRencontre);
        $data = $serializer->serialize($ratio, 'json', [
            'groups' => ['rencontre']
        ]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
