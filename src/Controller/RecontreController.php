<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Repository\TeamRepository;
use App\Repository\RencontreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/api/rencontres', name: 'rencontres.getAll', methods: ['GET'])]
    public function getRencontres(
        RencontreRepository $repository,
        SerializerInterface $serializer
    ): JsonResponse {
        $rencontres = $repository->findAll();
        $data = $serializer->serialize($rencontres, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
    //get one rencontre
    #[Route('/api/rencontres/{id}', name: 'rencontres.getOne', methods: ['GET'])]
    public function getOneRencontre(
        Rencontre $rencontre,
        SerializerInterface $serializer
    ): JsonResponse {
        $data = $serializer->serialize($rencontre, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    //get rencontre win by team
    #[Route('/api/rencontres/team/{id}', name: 'rencontres.getByTeam', methods: ['GET'])]
    public function getRencontreByTeam(
        TeamRepository $teamRepository,
        SerializerInterface $serializer,
        int $id
    ): JsonResponse {
        $team = $teamRepository->find($id);
        $rencontres = $team->getRencontreWin();
        $data = $serializer->serialize($rencontres, 'json', [
            'groups' => ['rencontre']
        ]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/api/teams/{id}/ratio', name: 'rencontre.getOneRatio', methods: ['GET'])]
    public function getOneTeamRatio(
        RencontreRepository $repository,
        SerializerInterface $serializer,
        int $id
    ): JsonResponse {
        $AllRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.teamA = :id')
            ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        $WinnerRencontre = $repository->createQueryBuilder('rencontre')
            ->where('rencontre.winner = :id')
            // ->orWhere('rencontre.teamB = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        $ratio = count($WinnerRencontre) / count($AllRencontre);
        $data = $serializer->serialize($ratio, 'json', [
            'groups' => 'rencontre'
        ]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
